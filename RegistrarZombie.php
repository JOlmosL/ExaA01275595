<?php

require_once("model.php");

conectar();

if (isset($_POST["NombreZombie"]) && isset($_POST["NombreZombie"]) != "")
{
    $NombreZombie = htmlspecialchars($_POST["NombreZombie"]);

    InsertZombie($NombreZombie);
    include("_TablaZombies.php");
}

else
{
    header("location:_TablaZombies.php");
}
?>