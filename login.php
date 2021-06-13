<?php
    require "include/funciones/funciones.php";
    include "include/config/database.php";
    $db = conectarDB();

    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === "POST"){

            $correo = mysqli_real_escape_string($db , filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL));

            $contraseña = mysqli_real_escape_string($db,$_POST['contraseña']);


        if(!$correo){

            $errores[] = " El correo es obligatorio";

        }

        if(!$contraseña){

            $errores[] = " La contraseña es obligatoria ";

        }

            if (empty($errores)) {
                $query = "SELECT * FROM usuarios WHERE correo = '${correo}';";
                $resultado = mysqli_query($db, $query);

                if ($resultado -> num_rows) {
                    $usuario = mysqli_fetch_assoc($resultado);
                    $contraseñaUsuario = $usuario['contraseña'];
                    $id = $usuario['id'];
                    $auth = password_verify($contraseña, $contraseñaUsuario);

                        if ($auth) {
                            session_start();
                            $_SESSION['nombre'] = $usuario['nombre'];
                            $_SESSION['login'] = true;
                            header("Location: index.php");
                        } else {

                          $errores[] = "Ponga bien la contra mijo";

                        }//contra mal error
                     } else{

                        $errores[] = 'El email no es correcto';

                     }
                  }//empty errores

    }// post
    if(isset($_GET['id']) ){

        $id = intval($_GET['id']);
          if( $id === 3){

        $errores[] = "DEBES INICIAR SESION ANTES";

     }
    }


    incluírTemplate("header")
?>
    <main class="main-login main">
        <h1>Iniciar Sesion</h1>
             <?php  foreach($errores as $error):?>
                <div class="alerta error"> <?php echo $error ?></div>
                <?php endforeach; ?>
    <div class="contenedor">

        <form method="POST">
            <legend>Ingresa tu Correo y Contraseña</legend>
            <div>
                <label for="email"> Email :</label>
                <input type="email" name="correo" placeholder="Tu email" require>
            </div>
            <div>
                <label for="email"> Constraseña </label>
                <input type="password" name="contraseña" placeholder="Tu contra" require>
            </div>
            <div class="contenedor-boton">

                <input class="boton" type="submit" value="Enviar">
            </div>

        </form>


    </div>

    </main>



<?php
incluírTemplate("footer");


?>