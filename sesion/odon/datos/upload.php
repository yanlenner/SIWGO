<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../../../src/css/font-awesome">
		<link rel="stylesheet" type="text/css" href="../../../src/css/int">
</head>
<body>
	<?php 
	if(empty($_POST['username']) || empty($_POST['password']))
	die("Error de conexión: Parece que las credenciales de acceso a las bases de datos son nulas o inválidas<br><br><h4 style='text-align:center;'><a href='restaurar' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
	$con = mysqli_connect("odontologia.uptm", "$_POST[username]", "$_POST[password]", "test") or die(mysql_error());
	$archivo=$_FILES['csv']['name'];
	$filePath = "file:///home/odontologia/$archivo";
	$tableName = "regularidad";
	$fieldDelimiter = ";";
	$lineDelimiter = "\n";
	$query = mysqli_query($con, "delete from regularidad");
	if($query){
// If your csv file has not a header row, remove the line "IGNORE 1 LINES".
		mysqli_query($con, '			
			LOAD DATA LOCAL INFILE "'.$filePath.'"	
			INTO TABLE '.$tableName.'				
			CHARSET latin1
			FIELDS TERMINATED by \'' . $fieldDelimiter . '\'
			LINES TERMINATED BY \'' . $lineDelimiter . '\'
			') or die(mysql_error());
	}
	$query = mysqli_query($con, "SELECT COUNT(*) AS total_rows FROM " . $tableName);
	$result = mysqli_fetch_array($query);
	$total_rows = $result['total_rows'];

	echo "<h1 style='text-align: center;'> Actualización Exitosa</h1>";
	echo "<h2 style='text-align: center; margin-top: 10%;'> $total_rows registros han sido agregados al nuevo listado</h2><h4 style='text-align: center;'><a href='./' target='_top' style='color: #66328f; text-decoration: none;'>Volver</a></h4>";

	?>
</body>
</html>