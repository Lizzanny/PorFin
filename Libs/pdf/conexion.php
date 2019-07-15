<?php 
define('MYSQL_BOTH',MYSQLI_BOTH);
define('MYSQL_NUM',MYSQLI_NUM);
define('MYSQL_ASSOC',MYSQLI_ASSOC);

		$server='127.0.0.1';
		$user='root';
		$pass='';//'4dmin';//4dmin
		$db_name='sigehi';

		//Cadena de Conexion
		$con=mysqli_connect($server,$user,$pass)or die ("Error en la conexion a la BBDD"); 
		// Seleccion de la base de datos 
		mysqli_select_db($con,$db_name)or die("No se a encontrado la base de datos");
		mysqli_set_charset($con, "utf8");

	 ?>