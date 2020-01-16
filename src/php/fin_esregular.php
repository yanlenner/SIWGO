<?php 

function getConnexion()
{
  $mysqli = new Mysqli('localhost', 'usuario', 'contraseña', 'test');
  if($mysqli->connect_errno) exit('Error en la conexión: ' . $mysqli->connect_errno);
  $mysqli->set_charset('utf8');
  return $mysqli;
}

function search()
{
  $mysqli = getConnexion();
  $search = $mysqli->real_escape_string($_POST['search']);
  $query = "SELECT count(cedula) as resultado FROM regularidad WHERE cedula = '$search' ";
  $res = $mysqli->query($query);
  $row = $res->fetch_array(MYSQLI_ASSOC);
  $resultado = $row['resultado'];
  if($resultado == 0)
    echo "false";
  else
    echo "true";
}

search();

?>