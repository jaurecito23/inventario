<?php

    require "include/config/database.php";
    require "include/funciones/funciones.php";

    $auth = estaAutenticado();


    if(!$auth){

      header("Location: /inventario/login.php?id=3");


    }

    $db = conectarDB();
    $errores= [];

    $nombre = '';
    $email = '';
    $contraseña ='';
    $contraseña2 = '';


      if($_SERVER['REQUEST_METHOD']=== 'POST'){


        $nombre = mysqli_real_escape_string($db,$_POST['nombre']);
        $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
        $contraseña = mysqli_real_escape_string($db,$_POST['contraseña']);
        $contraseña2 = mysqli_real_escape_string($db,$_POST['contraseña2']);

          if ($nombre === ''){

            $errores[] = 'El nombre es obligatorio';

          }

          if ($email === ''){

            $errores[] = 'El email es obligatorio';

          }

          if ($contraseña === ''){

            $errores[] = 'Debe incluír una contraseña';

          }

          if ($contraseña2 === ''){

            $errores[] = 'Debe verificar la contraseña';

          }

          if($contraseña !== $contraseña2 && $contraseña2 !== ''){


            $errores[] = "Las contraseñas no coinciden";

          }

          if(empty($errores)){

            $contraseñaHasheada = password_hash($contraseña, PASSWORD_DEFAULT);

            $query = "INSERT INTO usuarios (nombre,correo,contraseña) VALUES ('${nombre}','${email}' , '${contraseñaHasheada}');";

            $resultado  = mysqli_query($db,$query);

            if($resultado){

              header("Location: /inventario/index.php?id=1");


            }

          }

      //   $contraseñaHasheada = password_hash($contraseña, PASSWORD_DEFAULT);

      // $query = "INSERT INTO usuarios (correo,contraseña) VALUES ( '${email}' , '${contraseñaHasheada}');";

      //   $resultado  = mysqli_query($db,$query);

      //       echo $resultado;

      }



  incluírTemplate("header")
?>

 <main class="main-login main">
        <h1>Crear Usuario</h1>
             <?php  foreach($errores as $error):?>
                <div class="alerta error"> <?php echo $error ?></div>
                <?php endforeach; ?>
    <div class="contenedor">

        <form method="POST">
            <legend>Ingresa  el Correo y la Contraseña</legend>
            <div>
                <label for="nombre"> Nombre :</label>
                <input type="text" name="nombre" placeholder="Tu >Nombre" require>
            </div>
            <div>
                <label for="email"> Email :</label>
                <input type="email" name="email" id="email" placeholder="Tu email" require>
            </div>
            <div>
                <label for="contraseña"> Constraseña </label>
                <input type="password" name="contraseña" id="contraseña" placeholder="Tu contra" require>
            </div>
            <div>
                <label for="contraseña2"> Confirmar Constraseña </label>
                <input type="password" id="contraseña2" name="contraseña2" placeholder="Tu contra" require>
            </div>

            <div class="boton-end">

                <input class="boton" type="submit" value="Registrar">
            </div>

        </form>


    </div>

    </main>


<?php
incluírTemplate("footer");

?>