<?php 

function getConnexion()
{
  $mysqli = new Mysqli('localhost', 'odontologia', 'proyectoii', 'test');
  if($mysqli->connect_errno) exit('Error en la conexión: ' . $mysqli->connect_errno);
  $mysqli->set_charset('utf8');
  return $mysqli;
}

function search()
{
  $mysqli = getConnexion();
  $search = $mysqli->real_escape_string($_POST['search']);
  $query = "SELECT carnet FROM regularidad WHERE cedula = '$search' ";
  $res = $mysqli->query($query);
  $row = $res->fetch_array(MYSQLI_ASSOC);
  $count = mysqli_num_rows($res);
  if($count == 0)
    echo "false";
  else
    echo "$row[carnet]";
}


search();

?>