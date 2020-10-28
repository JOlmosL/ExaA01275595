<?php

require_once("model.php");

conectar();

if (isset($_POST["idCliente"]) && isset($_POST["idCliente"]) != ""
 && isset($_POST["direccionCliente"]) && isset($_POST["direccionCliente"]) != "" 
 && isset($_POST["poblacion"]) && isset($_POST["poblacion"]) != ""
 && isset($_POST["codigoPostal"]) && isset($_POST["codigoPostal"]) != ""
 && isset($_POST["telefono"]) && isset($_POST["telefono"]) != "")
{
    $idCliente = htmlspecialchars($_POST["idCliente"]);
    $direccionCliente = htmlspecialchars($_POST["direccionCliente"]);
    $poblacion = htmlspecialchars($_POST["poblacion"]);
    $codigoPostal = htmlspecialchars($_POST["codigoPostal"]);
    $telefono = htmlspecialchars($_POST["telefono"]);

    if (is_numeric($idCliente) && is_numeric($codigoPostal) && is_numeric($telefono))
    {
        ActualizarCliente($idCliente, $direccionCliente, $poblacion, $codigoPostal, $telefono);
        include("Exa2ParcialHome.php");
    }
}
else
{
    header("location:Exa2ParcialHome.php");
}
?>