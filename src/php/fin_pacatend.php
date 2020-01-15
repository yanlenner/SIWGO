<?php 

require_once 'conexion.php';

function search()
{
  $mysqli = getConnexion();
  $search = $mysqli->real_escape_string($_POST['search']);
  $query = "SELECT id_historia FROM estudiante WHERE cedula = '$search' ";
  $res = $mysqli->query($query);
  $row = $res->fetch_array(MYSQLI_ASSOC);
  $count = mysqli_num_rows($res);
  if($count == 0)
    echo "inexistente";
  else{
    $historia=$row['id_historia'];
    $query = "SELECT id_consulta from consulta WHERE id_historia = '$historia'";
    $res = $mysqli->query($query);
    $row = $res->fetch_array(MYSQLI_ASSOC);
    $count = mysqli_num_rows($res);
    if($count == 0)
      echo "false";
    else
      echo "true";
  }
}


search();

?>