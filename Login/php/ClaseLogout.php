<?php 
    
    session_start();
    include '../../Libs/conexionOracle.php';
//$id_det=$_SESSION['id_detal'];
//
//$sql_uda_det="UPDATE `deta_cone` SET `fec_sa` = CURRENT_TIMESTAMP WHERE `deta_cone`.`id_det` = '$id_det'";
//echo "sql--> ".$sql_uda_det."<br>";
//$resultado = mysqli_query($con,$sql_uda_det);

//if ($resultado) { 
//	echo "Se a modificado "."<br>";
//}else{
//	echo "NO se modifico "."<br>";
//}
    
    session_destroy();
    header('Location:../../Login/Login2.php');

?>