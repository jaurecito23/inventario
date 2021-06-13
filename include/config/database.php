<?php

    function conectarDB() :mysqli {


        $db = mysqli_connect("localhost","root","root","inventario");

        if(!$db){

            echo "No se Conecto";
            exit;

        };
        return $db;
    }



?>