<?php
    require "include/funciones/funciones.php";

    $auth = estaAutenticado();



    if(!$auth){

        header("Location: /inventario/login.php?id=3");

    }


    include "include/config/database.php";
    $db = conectarDB();



    $errores =[];
    $marca = "";
    $modelo = "";
    $tipo ="";
    $cantidad = "";
    $stock  = "";
    $marcaBuscar ="";

    $mostrarCartel = false;

    $aviso = intval($_GET["id"] ?? NULL);





              if($_SERVER["REQUEST_METHOD"] === "POST"){





                  if(isset($_POST['id'])){

                      $id = $_POST['id'];
                      $query = "DELETE FROM templados WHERE id = ${id}";

                      $eliminar = mysqli_query($db,$query);

                      if($eliminar){

                          header('Location: /inventario/vidrios-templados.php?id=1');
                        }

                    }

                    if(isset($_POST["marca-buscar"])){

                        $marcaBuscar = $_POST["marca-buscar"];
            $buscar = "SELECT * FROM templados WHERE(marca = '$marcaBuscar')";

            $busqueda = mysqli_query($db,$buscar);

            $cantidadDeEstuches = mysqli_num_rows($busqueda);

            if($cantidadDeEstuches === 0){

                $errores[] = "No hay templados de esa marca";

            }

            // while($marca = mysqli_fetch_assoc($busqueda)){

            }

            //     echo "<pre>";
            //         var_dump($marca);
            //     echo "</pre>";
            // }
            // var_dump($marcaBuscar);
        if(isset($_POST["marca"])){

            $marca = $_POST['marca'];
            $modelo = $_POST["modelo"];
            $tipo = $_POST['tipo'];
            $cantidad = intval($_POST["cantidad"]);
            $stock  = $_POST["stock"];




            if($marca === ""){

                $errores[] = "Debes Poner una Marca";

            };
            if($modelo === ""){

                $errores[] = "Debes Elegir un Modelo";

            };
            if($tipo === NULL){

                $errores[] = "No olvide seleccionar el tipo de vidrio ";

            };
            if($cantidad === 0){

                $errores[] = "La cantidad debe ser mayor o igual a 1";

            };





            if (empty($errores)) {
                $query = "INSERT INTO templados (marca,modelo,tipo,cantidad,stock) VALUES ('$marca','$modelo','$tipo','$cantidad','$stock')";

                $resultado = mysqli_query($db, $query);


                if ($resultado) {
                    $mostrarCartel = true;
                }
            }
        }
    }

    incluírTemplate("header");


    ?>

        <?php foreach($errores as $error):?>

                        <div class="alerta error"><?php echo $error ?> </div>


                    <?php endforeach ?>

    <main class="main">
        <h2>¿ Que haremos ?</h2>
           <?php if($mostrarCartel === true){?>

                                <div class="alerta excelente"><h3>Insertado Correctamente</h3></div>

                            <?php } ?>

                            <?php

if($aviso === 1):?>

                                <div class="alerta excelente alerta-id"><h3>Borrado Correctamente</h3></div>

                            <?php endif;?>
         <div class="contenedor-botones">
            <div class="botones">
                    <div class="contenedor-boton">

                        <button id="nuevo">Nuevo</button>
                        <div id="opciones-nuevos" class="opciones-nuevo opciones oculto">
                            <button class="crear-templado"> Crear Templado </button>
                            <button class="stockear-templado"> Stockear Templado </button>



                             <div class="contenedor-formulario-templados">

                            <form class="formulario-templados oculto" action="vidrios-templados.php" method="POST">
                                <fieldset>
                                    <legend>Crea un nuevo vidrio templado:</legend>

                                    <div class="campo">
                                    <label for="marca" >Marca</label>
                                    <input id="marca" name="marca" value="<?php echo $marca ?>"  type="text" placeholder="Ej:Samsung">
                                    </div>

                                     <div class="campo">
                                    <label for="modelo" >Modelo</label>
                                    <input name="modelo" value="<?php echo $modelo ?>"  id="modelo" type="text" placeholder="Ej: S8">
                                    </div>

                                    <label> Tipo: </label>

                                    <div class="campo">
                                    <label for="tipo1">Común</label>
                                    <input  name="tipo" id="tipo1" value="comun" type="radio">
                                    <label for="tipo2">9D</label>
                                    <input name="tipo" id="tipo2" value="9D" type="radio">
                                    </div>

                                    <div class="campo">
                                    <label for="cantidad">Cantidad</label>
                                    <input  name="cantidad" id="cantidad" type="number" value="<?php echo $cantidad ?>"  min="1">
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
                                <form action="vidrios-templados.php" method="POST">
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
         </div>

<div class="contenedor-lista-templados">
<?php
    if($marcaBuscar):?>
            <div class="formulario-buscar block"><!--hereda la clase-->
                <input type="seacrh" class="input-buscar" placeholder="Buscar...">
             </div>
       <?php while ($templado = mysqli_fetch_assoc($busqueda)):?>

<div class="templado">
    <h3>Modelo: <?php echo $templado["modelo"]?></h3>
    <h4>Marca: <span><?php echo $templado["marca"]?></span></h4>
    <p>Tipo: <?php echo $templado["tipo"]?></p>
    <p>Cantidad: <?php echo $templado["cantidad"]?></p>
    <p>Stock: <span><?php echo $templado["stock"]?></span ></p>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $templado['id']?>">
        <input type="submit" value="borrar" name="borrar">
    </form>
</div>

  <?php endwhile; endif;?>
</div>

        </main>


<?php
incluírTemplate("footer");

?>

