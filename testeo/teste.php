<?php
/*Autor: Elias Alejandro
  Fecha Inicio:  Miercoles 10/Julio/2019
  Fecha Termino:  Viernes 12/Julio/2019
  Descripcion: 
    Este metodo realiza el testeo de las base de datos remotas alas que se quiere conectar
    esto con el fin de comprobar la conexion y generar un reporte
*/
include_once '../Libs/ConexionOracle.php'; 
class ClaseTesteo extends ConexionOracle{
    //atributo 
  protected $cnx= array(); //informacion de conexion

  function __construct(){
      parent::__construct();
      $this->getMetodoAcceso();
	}

    //metodo para obtener la informacion de las bases de datos remotas
  private function getDatosConexionesRemotas(){
    $sql= "SELECT * FROM C_DBLINKS";
    $stmt = oci_parse($this->con2, $sql);
    oci_execute($stmt);
     /*  */

  
	  for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){
          
      //llamar al metodo comprobar conexion de las base de datos remotos
      $host= trim($row["IP"]);
      $base= trim($row["SID"]);
      $user= trim($row["USUARIO"]);
      $pass= trim($row["CLAVE"]);
      $nomb= trim($row["DB_INSTANCE"]);
      $dblink= trim($row["DB_NAME"]);
          
      $conex= 0;//$this->ProbarConexionBaseRemota($host,$base,$user,$pass);
      $this->cnx[$i]= $valor =  array('clve' => $row['CT_CLAVE'],
                                       'nomb' => $row['DB_INSTANCE'],
                                       'host' => $row['IP'],
                                       'base' => $row['SID'],
                                       'user' => $row['USUARIO'],
                                       'pass' => $row['CLAVE'],
                                       'cone' => $conex
                                      );  
    }
      //$this->loteprimer(); 
  }


    //metodo privado para testing de las bases de datos remotas 
  private function ProbarConexionBaseRemota($host,$daba,$user,$pass){
      $checar=0; 
      try{    
          $base= new PDO("oci:dbname=$host/$daba;charset=utf8" ,$user ,$pass);
          $checar=1;
          $this->getInformacionCedulas($base); 
      }catch(PDOException $e){
           //echo "SE ENCONTRO EL SIGUINETE ERROR"+ $e->getMessage( );
           $checar=0;
      }
      return $checar; 
  }



    //metodo publico de acceso para llamar a metodo privados
  public function getMetodoAcceso(){
      $this->getDatosConexionesRemotas(); 
     
      //echo json_encode($this->cnx); 
  }

}//endmyClass

    $ob = new ClaseTesteo();
    $ob->getMetodoAcceso();  
    $ob->cerrarConexion2(); 
?>