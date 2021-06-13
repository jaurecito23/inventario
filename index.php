<?php require "include/funciones/funciones.php";
     require "include/config/database.php";
    $auth = estaAutenticado();



    if(!$auth){

        header("Location: /inventario/login.php?id=3");

    }

     $id = "";
    if(isset($_GET['id'])){

        $id = intval($_GET['id']);

    }



    incluírTemplate("header");

?>



<main class="main contenedor">
    <div class="contenido-main">

            <h2>Facundo Jauregui</h2>

            <?php if($id === 1): ?>

                <div class="alerta excelente">El usuario fue creado</div>


                <?php endif; ?>
            <picture>
            <source srcset="build/img/miniatura.webp" type="image/webp">
            <source srcset="build/img/miniatura.png" type="image/png">
            <img loading="lazy" src="build/img/miniatura.webp" alt="Miniatura Todocel">
            </picture>
            <p> Visitar esta pagina con permiso de jaure , de lo contrario puede ser sometido a un buen sermon</p>

    </div>
</main>

<?php
    // Cerrar conexion

    incluírTemplate("footer");
?>