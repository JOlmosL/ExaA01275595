<?php
//Libreria de interacciones

function conectar() 
{

    $conexion_bd = mysqli_connect("exa-db-a01275595-do-user-8217587-0.b.db.ondigitalocean.com","doadmin","ysuucn7048n2le7u","Exa2Parcial", "25060");
    
    if ($conexion_bd == NULL) 
    {
        die("No se pudo conectar a la base de datos");
    }
    
    $conexion_bd->set_charset("utf8");
    
    return $conexion_bd;
}

function desconectar($conexion_bd) 
{
    mysqli_close($conexion_bd);
}

function tablaZombie() 
{
    $consulta = 'SELECT * ';
    $consulta .= 'FROM ZOMBIE';
    $consulta .= 'ORDER BY NumZombie';
    
    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
    
    $resultado = '<table class="table">';
    $resultado .= '<thead><tr><th scope="col">Numero de Zombie</th><th scope="col">Nombre del Zombie</th></thead>';

    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) 
    {
        $resultado .= '<tbody>';    
        $resultado .= '<tr>';
        $resultado .= '<th scope="row">'.$row["NumZombie"].'</th>';
        $resultado .= '<td>'.$row["NombreZombie"].'</td>';
        $resultado .= '</tr>';
        $resultado .= '</tbody>';
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</table>';
    
    desconectar($conexion_bd);
    return $resultado;
}

function tablaEstado() 
{
    $consulta = 'SELECT * ';
    $consulta .= 'FROM ESTADO';
    $consulta .= 'ORDER BY NumEstado';
    
    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
    
    $resultado = '<table class="table">';
    $resultado .= '<thead><tr><th scope="row">Numero de Estado</th><th scope="row">Significado</th></tr></thead>';

    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) 
    { 
    //MYSQLI_NUM: Devuelve los resultados en un arreglo numérico
        //$row[0]
    //MYSQLI_ASSOC: Devuelve los resultados en un arreglo asociativo
        //$row["acusador"]
    //MYSQL_BOTH: Devuelve los resultados en un arreglo numérico y asociativo (Utiliza el doble de memoria)
        //$row[0] y $row["acusador"]
        
        $resultado .= '<tbody>';
        $resultado .= '<tr>';
        $resultado .= '<th scope="row">'.$row["NumEstado"].'</th>';
        $resultado .= '<td>'.$row["NombreEstado"].'</td>';
        $resultado .= '</tr>';
        $resultado .= '</tbody>';
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</table>';
    
    desconectar($conexion_bd);
    return $resultado;
}

function tablaRegistro()
{
    $consulta = 'SELECT * ';
    $consulta .= 'FROM REGISTRO';
    
    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
    
    $resultado = '<table class="table">';
    $resultado .= '<thead><tr><th scope="col">Numero de Zombie</th><th scope="col">Numero de Estado</th><th scope="col">Fecha y Hora de Registro</th></tr></thead>';

    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) 
    {   
        $resultado .= '<tbody>';     
        $resultado .= '<tr>';
        $resultado .= '<th scope="row">'.$row["NumZombie"].'</th>';
        $resultado .= '<th scope="row">'.$row["NumEstado"].'</th>';
        $resultado .= '<td>'.$row["FechaHora"].'</td>';
        $resultado .= '</tr>';
        $resultado .= '</tbody>';
    }
    
    mysqli_free_result($resultados_consulta);
    
    $resultado .= '</table>';
    
    desconectar($conexion_bd);
    return $resultado;
}



function InsertZombie($NombreZombie)
{
     
    $conexion_bd = conectar();
    
    $consulta = 'INSERT INTO ZOMBIE (NombreZombie) VALUES (?)';
    //Parametros son los signos de interrogación

    //Verifica que la consulta sea correcta
    if(!($statement = $conexion_bd->prepare($consulta))) 
    {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    //Evita +- SQL inyection | Hace la union entre los parametros con las cosultas/Sustituye ?s por datos
    if(!($statement->bind_param("s", $NombreZombie))) 
    {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) 
    {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);
}

function EstadoActual($NumZombie, $NumEstado)
{
     
    $conexion_bd = conectar();
    
    $consulta = 'INSERT INTO REGISTRO (NumZombie, NumEstado) VALUES (?,?)';
    //Parametros son los signos de interrogación

    //Verifica que la consulta sea correcta
    if(!($statement = $conexion_bd->prepare($consulta))) 
    {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    //Evita +- SQL inyection | Hace la union entre los parametros con las cosultas/Sustituye ?s por datos
    if(!($statement->bind_param("ss", $NumZombie, $NumEstado)))
    {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) 
    {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);
}

function ActualizarCliente($idCliente, $direccionCliente, $poblacion, $codigoPostal, $telefono)
{
    $conexion_bd = conectar();
    
    $consulta = "UPDATE CLIENTE SET direccionCliente = ?, poblacion = ?, codigoPostal = ?, telefono = ? WHERE idCliente = ?";
    //Parametros son los signos de interrogación

    //Verifica que la consulta sea correcta
    if(!($statement = $conexion_bd->prepare($consulta))) 
    {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    //Evita +- SQL inyection | Hace la union entre los parametros con las cosultas/Sustituye ??s por datos
    if(!($statement->bind_param("sssss", $direccionCliente, $poblacion, $codigoPostal, $telefono, $idCliente))) 
    {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) 
    {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);
}

function select($name, $tabla, $id="id", $nombre="nombre") 
{
    $resultado = '<select name="'.$name.'" class="browser-default">';
    $resultado .= '<option value="" disabled selected>Selecciona un '.$tabla.'</option>';
    $conexion_bd = conectar();
    
    $consulta = 'SELECT '.$id.', '.$nombre.' FROM '.$tabla.' ORDER BY '.$nombre.' ASC'; //SELECT idCliente, nombreCliente FROM CLIENTE ORDER BY nombreCliente 
    $resultados_consulta = $conexion_bd->query($consulta);  
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_BOTH)) 
    {
        
        $resultado .= '<option value="'.$row[$id].'">'.$row[$nombre].'</option>';
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</select><label>'.$tabla.'</label>';
    
    desconectar($conexion_bd);
    return $resultado;
}
//echo select("cliente", "cliente", "idCliente", "nombreCliente");

function updateColorAuto($matricula, $nuevoColor = 'Negro') 
{
     
    $conexion_bd = conectar();
    
    $consulta = "UPDATE coche_vendido SET color = ? WHERE matricula = ?";
    //Parametros son los signos de interrogación


    //Verifica que la consulta sea correcta
    if(!($statement = $conexion_bd->prepare($consulta))) 
    {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    //Evita +- SQL inyection | Hace la union entre los parametros con las cosultas/Sustituye ??s por datos
    if(!($statement->bind_param("ss",$nuevoColor, $matricula))) 
    {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) 
    {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);
}
//updateColorAuto('V8018LJ', 'Verde');
//echo tablaCocheVenta();
?>