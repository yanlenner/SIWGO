<?php 
error_reporting(0);
require_once 'conexion.php';

function spar(int $b){
        if($b % 2 == 0)
        return true;
        else
        return false;
        }

        function lenner(string $a)
        {
        $sz = strlen($a); 
        $vector; 
        $cat; 
        $b;
        $i;
        $x;

        for($i=0; $i<$sz; $i++)
            $vector[$i]=ord($a[$i]);
            
        for($i=0; $i<$sz; $i++){
            $x=$vector[$i]; 
        if(spar($x-5))
            $vector[$i]-=5;            
        else
            $vector[$i]-=1;
        }

        for($i=0; $i<$sz; $i++){
        $b[$i]=chr($vector[$i]);
        $cadena .=$b[$i];
        }

        return $cadena;
        }

function search()
{
  $mysqli = getConnexion();
  $search = $mysqli->real_escape_string($_POST['search']);
  $query = "SELECT usuario FROM trabajador WHERE cedula = '$search' ";
  $res = $mysqli->query($query);
  $row = $res->fetch_array(MYSQLI_ASSOC);
  $count = mysqli_num_rows($res);
    if($count == 0)
      echo "false";
    else
      echo lenner($row['usuario']);
}

search();

?>
