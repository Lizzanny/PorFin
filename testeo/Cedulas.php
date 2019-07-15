<?php
/*Autor: Elias Alejandro
  Fecha Inicio:  Miercoles 10/Julio/2019
  Fecha Termino:  Viernes 12/Julio/2019
  Descripcion: 
    Este metodo realiza el testeo de las base de datos remotas alas que se quiere conectar
    esto con el fin de comprobar la conexion y generar un reporte
*/
include_once '../Libs/ConexionOracle.php'; 
class Cedulas extends ClaseTesteo{

    private $cnxcedula;

    public function  obtnerInformacionCedulas(){
    $this->cnxcedula = mysqli_connect($this->host,$this->user,$this->pass)or die ("Error en la conexion a la BBDD"); 
        // Seleccion de la base de datos 
        mysqli_select_db($this->cnxcedula,$this->daba)or die("No se a encontrado la base de datos");
        mysqli_set_charset($this->conM, "utf8");
    }
    



}

$ob = new Cedulas();
$ob->getMetodoAcceso();  
$ob->cerrarConexion2(); 
?>