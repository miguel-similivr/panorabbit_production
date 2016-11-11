<?php

/**
*insert header title
*
*/

    function insertTitle($data= []){
        extract($data);
        require("header_new.php");
    }


    function renderHeader($data = [])
    {
        extract($data);
        require("header.php");
    }


?>