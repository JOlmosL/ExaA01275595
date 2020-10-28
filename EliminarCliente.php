<?php

require_once("model.php");

conectar();

if (isset($_POST["idCliente"]) && isset($_POST["idCliente"]) != "")
{
    $idCliente = htmlspecialchars($_POST["idCliente"]);

    if (is_numeric($idCliente))
    {
        EliminarCliente($idCliente);
        include("Exa2ParcialBone.php");
    }
}
else
{
    header("location:Exa2ParcialBone.php");
}
?>