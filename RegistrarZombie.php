<?php

require_once("model.php");
include("Exa2ParcialHome.php");
conectar();

if (isset($_POST["NombreZombie"]) && isset($_POST["NombreZombie"]) != ""
{
    $NombreZombie = htmlspecialchars($_POST["NombreZombie"]);

    InsertZombie($NombreZombie);
    include("Exa2ParcialHome.php");
}

else
{
    header("location:Exa2ParcialHome.php");
}
?>