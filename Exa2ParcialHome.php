<?php

require_once "model.php";

if (isset($_POST["NombreZombie"]) && isset($_POST["NombreZombie"]) != ""
{
    $NombreZombie = htmlspecialchars($_POST["NombreZombie"]);

    InsertZombie($NombreZombie);
    include("Exa2ParcialHome.php");
}

    include("_Exa2ParcialHeader.html");

    include("_Exa2ParcialTables.html");

    include("_Exa2ParcialInfo.html");

    include("_Exa2ParcialFooter.html");

?>