<?php 

require_once 'conexion.php';

function search()
{
  $mysqli = getConnexion();
  $search = $mysqli->real_escape_string($_POST['search']);
  $query = "SELECT fecha FROM persona WHERE cedula = '$search' ";
  $res = $mysqli->query($query);
  $row = $res->fetch_array(MYSQLI_ASSOC);
  $count = mysqli_num_rows($res);
  if($count == 0)
    echo "false";
  else{
    $fecha2 = date_create_from_format('Y-m-d', $row['fecha']);
    $fecha = date_format($fecha2, 'd/m/Y'); 
    echo "$fecha";
  }
}

search();

?>