<?php
    require "include/funciones/funciones.php";


    $auth = estaAutenticado();



    if(!$auth){

        header("Location: /inventario/login.php?id=3");

    }


    include "include/config/database.php";

    $db = conectarDB();

    $marca = "";
    $modelo = "";
    $cantidad = "";
    $color= "";
    $stock = "";
    $marcaBuscar ="";
    $aviso = "";

   if(isset($_GET["id"])){

        $aviso = intval($_GET["id"]);

   }



    $errores = [];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if(isset($_POST["borrar"])){

                    $id = $_POST['id'];
                    $query = "DELETE FROM estuches WHERE id = ${id}";
                    $resultado = mysqli_query($db,$query);

                    if($resultado){


                        header("Location: estuches.php?id=1");

                    }

                }


        if(isset($_POST["marca-buscar"])){

            $marcaBuscar = $_POST["marca-buscar"];
        $buscar = "SELECT * FROM estuches WHERE marca = '$marcaBuscar'";
        $busqueda = mysqli_query($db, $buscar);

        $cantidadDeEstuches = mysqli_num_rows($busqueda);
            if($cantidadDeEstuches ===  0){

                $errores[] = "No hay estuches de esa marca";

            }


        }


        if (isset($_POST["marca"])) {
            $marca = $_POST["marca"];
            $modelo = $_POST["modelo"];
            $cantidad = intval($_POST["cantidad"]);
            $color= $_POST["color"];
            $stock = $_POST["stock"];

            if ($marca === "") {
                $errores[] = "Pone una Marca";
            }

            if ($modelo === "") {
                $errores[] = "No olvides poner Modelo";
            }
            if ($cantidad=== "") {
                $errores[] = "Debes ingrear una cantidad";
            }
            if ($color=== "") {
                $errores[] = "Debes Elegir el color";
            }

            if (empty($errores)) {
                $query = "INSERT INTO estuches (marca,modelo,cantidad,color,stock) VALUES ('$marca','$modelo','$cantidad','$color','$stock')";

                $resultado = mysqli_query($db, $query);
                if (!$resultado) {
                    echo "No se inserto";
                }
            }
        }
    }
    incluírTemplate("header");
    ?>


<main class="main">


    <h2> Estuches </h2>

    <?php  if( $aviso === 1):?>

    <div class="alerta excelente alerta-id" > <h3>Borrado Correctamente </h3></div>

    <?php endif; ?>

    <?php foreach ($errores as $error) {?>

        <div class="alerta error"><?php echo $error?> </div>


        <?php } ?>





    <div class="contenedor-botones">
            <div class="botones">
                    <div class="contenedor-boton">

                        <button id="nuevo">Nuevo</button>
                        <div id="opciones-nuevos" class="opciones-nuevo opciones oculto">
                            <button class="crear-templado"> Crear Estuche </button>
                            <button class="stockear-templado"> Stockear Estuche</button>
                             <div class="contenedor-formulario-templados">

                            <form class="formulario-templados oculto" action="estuches.php" method="POST">
                                <fieldset>
                                    <legend>Crea un nuevo estuche:</legend>

                                    <div class="campo">
                                    <label for="marca" >Marca</label>
                                    <input id="marca" name="marca" value="<?php echo $marca ?>"  type="text" placeholder="Ej:Samsung">
                                    </div>

                                     <div class="campo">
                                    <label for="modelo" >Modelo</label>
                                    <input value="<?php echo $modelo ?>" name="modelo" id="modelo" type="text" placeholder="Ej: S8">
                                    </div>

                                    <div class="campo">
                                    <label for="cantidad">Cantidad</label>
                                    <input  name="cantidad" id="cantidad" value="<?php echo $cantidad ?>" type="number" min="1" placeholder="Ej: 3">
                                    </div>

                                    <div class="campo">
                                        <label for="color">Color</label>
                                        <input name="color" id="color" type="text" placeholder="Ej: Verde" value="<?php echo $color ?>">
                                    </div>

                                    <div class="campo">
                                    <label for="stock">Stock</label>
                                    <select name="stock">
                                        <option selected> True </option>
                                        <option disabled> False </option>
                                    </select>
                                </div>

                                <div class="submit">

                                    <input value="Enviar" type="submit">

                                </div>
                                </fieldset>

                            </form>

                        </div>
                        </div>

                    </div>

                    <div class="contenedor-boton">

                        <button id="ver">Ver</button>
                        <div id="opciones-ver" class="opciones-ver opciones oculto">
                            <button class="elegir-marca">Elegir Marca</button>
                            <div class="marcas">
                                <form method="POST">
                                    <select name="marca-buscar">
                                        <option selected disabled>--Selecciona una Marca</option>
                                        <option>Xiaomi</option>
                                        <option>Huawei</option>
                                        <option>Samsung</option>
                                        <option>LG</option>
                                        <option>Nokia</option>
                                        <option>Iphone</option>
                                        <option>Otro</option>
                                    </select>
                                      <div class="submit">
                                    <input class="buscar" type="submit" value="Buscar" class="boton">
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                      <div class="contenedor-boton">
                        <button id="borrar">Borrar</button>
                        <div id="opciones-borrar" class="opciones-borrar opciones oculto ">
                            <button class="eliminar-stock"> Eliminar Stock </button>
                        </div>
                    </div>
                </div>
            </div>
         </div> <!--Cierra contenedor Botones-->

         <div class="contenedor-lista-templados">


         <?php if($marcaBuscar):?>
            <div class="formulario-buscar block"><!--hereda la clase-->
                <input type="seacrh" class="input-buscar" placeholder="Buscar...">
             </div>
            <?php while($estuche = mysqli_fetch_assoc($busqueda)):?>

                <div class="templado">
                    <h3>Modelo: <?php echo $estuche["modelo"]?></h3>
                    <h4>Marca: <span><?php echo $estuche["marca"]?></span></h4>
                    <p>Color: <?php echo $estuche["color"]?></p>
                    <p>Cantidad: <?php echo $estuche["cantidad"]?></p>
                    <p>Stock: <span><?php echo $estuche["stock"]?></span ></p>
                <form method="POST">
                        <input type="hidden" value="<?php echo $estuche["id"];?>" name="id">
                      <input type="submit" value="Borrar" name="borrar">

                </form>
        </div>




        <?php endwhile; endif;?>

    </div>

</main>




<?php
incluírTemplate("footer")
?>



