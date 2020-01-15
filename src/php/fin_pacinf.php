<?php 

require_once 'conexion.php';

function search()
{
  $mysqli = getConnexion();
  $search = $mysqli->real_escape_string($_POST['search']);
  $query = "SELECT aspecto, hallazgo, observacion, respuesta FROM estudiante WHERE cedula = '$search' ";
  $res = $mysqli->query($query);
  $row = $res->fetch_array(MYSQLI_ASSOC);
  $uno=$row['aspecto'];
  $dos=$row['hallazgo'];
  $tre=$row['observacion'];
  $cua=$row['respuesta'];
  if($uno || $dos || $tre || $cua != null)
    echo "true";
  else
    echo "false";
}


search();

?>