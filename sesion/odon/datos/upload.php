<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../../../src/css/font-awesome">
	<link rel="stylesheet" href="../../../src/css/bootstrap">
    <link rel="stylesheet" href="../../../src/css/int">
</head>
<body>
	<?php 
	error_reporting(0);
	$con = mysqli_connect("odontologia.uptm", "$_POST[username]", "$_POST[password]", "test") or die("<h2 style='text-align: center; margin-top: 12%;'> Error de conexión: Parece que las credenciales de acceso a las bases de datos son nulas o inválidas </h2><h4><a href='exportar' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
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