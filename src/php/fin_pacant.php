<?php 

require_once 'conexion.php';




function search()
{
  $mysqli = getConnexion();
  $search = $mysqli->real_escape_string($_POST['search']);
  $query = "SELECT id_historia FROM estudiante WHERE cedula = '$search' ";
  $res = $mysqli->query($query);
  $hist = $res->fetch_array(MYSQLI_ASSOC);
  $hist = $hist['id_historia'];
  $query = "SELECT nombre_antecedente FROM antecedente WHERE id_historia = '$hist' ";
  $res = $mysqli->query($query);
  while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
   $cadena .=' '.$row['nombre_antecedente'];
 }

 echo $cadena;
}

search();

?>