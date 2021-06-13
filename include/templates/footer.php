<?php

    $auth = "";
    $nombre= "";

    if( isset($_SESSION['nombre'])){
        $nombre = $_SESSION['nombre'];
    }
     if(isset($_SESSION['login'])){
         $auth = $_SESSION['login'];
    }

?>


<footer class="footer">

            <h2 class="nombre-usuario"> Usuario: <?php echo $nombre ?> </h2>

    <div class="contenido-footer">
    <div class="contenedor-navegacion">
         <nav class="navegacion">
                <a href="vidrios-templados.php">Vidrios Templados</a>
                <a href="#">Accesorios</a>
                <a href="estuches.php">Estuches</a>
                  <?php if($auth):?>
                <a href="crearusuario.php">Crear Usuario</a>
                <a href="cerrarsesion.php">Cerrar Sesion</a>
                <?php endif;?>
            </nav>
    </div>
    <div class="derechos">
        <p> Todos los derechos Reservados &copy Facundo Jauregui</p>
    </div>
</div>
</footer>

    <script src="build/js/bundle.min.js"></script>
</body>
</html>