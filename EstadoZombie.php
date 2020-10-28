<?php

require_once("model.php");

conectar();

if (isset($_POST["NumZombie"]) && isset($_POST["NumZombie"]) != "" && isset($_POST["NumEstado"]) && isset($_POST["NumEstado"]) != "")
{
    $NumZombie = htmlspecialchars($_POST["NumZombie"]);
    $NumEstado = htmlspecialchars($_POST["NumEstado"]);

    if (is_numeric($NumZombie) && is_numeric($NumEstado))
    {
        EstadoActual($NumZombie, $NumEstado);
        include("_TablaRegistro.php");
    }
}

else
{
    header("location:_TablaRegistro.php");
}
?>