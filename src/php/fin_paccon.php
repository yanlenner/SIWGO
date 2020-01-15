<?php 

require_once 'conexion.php';

function search()
{
  $mysqli = getConnexion();
  $search = $mysqli->real_escape_string($_POST['search']);
  $query = "SELECT id_historia FROM estudiante WHERE cedula = '$search' ";
  $res = $mysqli->query($query);
  $row = $res->fetch_array(MYSQLI_ASSOC);
  $hist=$row['id_historia'];

  $query = "SELECT found_rows() as consultas FROM consulta WHERE id_historia = '$hist' ";
  $res = $mysqli->query($query);
  $row = $res->fetch_array(MYSQLI_ASSOC);

  if($row['consultas'] == 0)
    echo "false";
  else
    echo "true";
}


search();

?>