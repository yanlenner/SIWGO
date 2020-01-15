<?php 
require('conexion.php');
function ofecha($f){
				$fecha2 = date_create_from_format('Y-m-d G:i:s', $f);
    			$fecha = date_format($fecha2, 'd/m/Y G:i:s'); 
    			return $fecha;
			}
$mysqli = getConnexion();


$sql  = "SELECT id_visita, enlace, tiempo from registro_devisitas where id_sesion like '$_POST[usuario]'"; 
$res = $mysqli->query($sql);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['tiempo']=ofecha($row['tiempo']);
	$data[] = $row;
}

$results = ["sEcho" => 1,

"iTotalRecords" => count($data),

"iTotalDisplayRecords" => count($data),

"aaData" => $data ];

mysqli_close($mysqli);

echo json_encode($results);

?>