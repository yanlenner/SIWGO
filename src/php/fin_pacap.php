<?php 

require_once 'conexion.php';

function search()
{
  $mysqli = getConnexion();
  $search = $mysqli->real_escape_string($_POST['search']);
  $query = "SELECT apellido FROM persona WHERE cedula = '$search' ";
  $res = $mysqli->query($query);
  $row = $res->fetch_array(MYSQLI_ASSOC);
  $count = mysqli_num_rows($res);
  if($count == 0)
    echo "false";
  else
    echo "$row[apellido]";
}

search();

?>
