<?php

require_once("model.php");

conectar();

if (isset($_POST["idCliente"]) && isset($_POST["idCliente"]) != "")
{
    $idCliente = htmlspecialchars($_POST["idCliente"]);

    if (is_numeric($idCliente))
    {
        EstadoActual($idCliente);
        include("Exa2ParcialHome.php");
    }
}
else
{
    header("location:Exa2ParcialHome.php");
}
?>