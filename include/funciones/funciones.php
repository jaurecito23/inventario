<?php
    function incluírTemplate(string $nombre){
       include "include/templates/${nombre}.php";
    }
    function estaAutenticado(){

        session_start();

        $auth = $_SESSION['login'];

        if($auth){

            return true;

        }else{

            return false;

        }



    }

    function debuguear($var){

        echo "<pre>";
            var_dump($var);
        echo "</pre>";
        exit;


    }

?>