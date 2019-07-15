<?php
/*Autor: Elias Alejandro
  Fecha Inicio:  Miercoles 10/Julio/2019
  Fecha Termino:  Viernes 12/Julio/2019
  Descripcion: 
    Este metodo realiza el testeo de las base de datos remotas alas que se quiere conectar
    esto con el fin de comprobar la conexion y generar un reporte
*/
include_once '../Libs/ConexionOracle.php'; 
class ClaseTesteo extends ConexionOracle
{
    //atributo 
    private $cnx= array(); //informacion de conexion

    function __construct(){
		parent::__construct();
	}

    //metodo para obtener la informacion de las bases de datos remotas
    private function getDatosConexionesRemotas()
    {
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
            
            //if($row['CT_CLAVE']!=401){
                //$conex= $this->ProbarConexionBaseRemota($host,$base,$user,$pass);
                $cnxdblink= $this->ProbarConexionbdlink($dblink); 
                $this->cnx[$i]= $valor =  array('clve' => $row['CT_CLAVE'],
                                                 'nomb' => $row['DB_INSTANCE'],
                                                 'host' => $row['IP'],
                                                 'base' => $row['SID'],
                                                 'user' => $row['USUARIO'],
                                                 'pass' => $row['CLAVE'],
                                                 'cone' => $cnxdblink
                                                );  
            //}
            
        }
        //$this->loteprimer(); 
    }


    public function loteprimer(){
        $tamanioarry=sizeof($this->cnx); 
        //echo "-s-s-s-s-". $tamanioarry; 
      
        for ($i=0; $i<10; $i++){   
            $nomb=$this->cnx[$i]["nomb"];    
            $host=$this->cnx[$i]["host"];
            $base=$this->cnx[$i]["base"];
            $user=$this->cnx[$i]["user"];
            $pass=$this->cnx[$i]["pass"];
           
            $conex= $this->ProbarConexionBaseRemota($host,$base,$user,$pass);
            echo "$conex,  $nomb <br>"; 
        }
      
        for ($i=10; $i<19; $i++){       
            $nomb=$this->cnx[$i]["nomb"];    
            $host=$this->cnx[$i]["host"];
            $base=$this->cnx[$i]["base"];
            $user=$this->cnx[$i]["user"];
            $pass=$this->cnx[$i]["pass"];
            $conex= $this->ProbarConexionBaseRemota($host,$base,$user,$pass);
            echo "$conex,  $nomb <br>"; 
        } 

        
        for ($i=20; $i<$tamanioarry; $i++){  
            $nomb=$this->cnx[$i]["nomb"];    
            $host=$this->cnx[$i]["host"];
            $base=$this->cnx[$i]["base"];
            $user=$this->cnx[$i]["user"];
            $pass=$this->cnx[$i]["pass"];
            $conex= $this->ProbarConexionBaseRemota($host,$base,$user,$pass);
            echo "$conex,  $nomb <br>"; 
        }


    }



    //metodo privado para testing de las bases de datos remotas 
    private function ProbarConexionBaseRemota($host,$daba,$user,$pass)
    {
        $checar=0; 
        try{    
            //$stringconex= "oci:dbname=$host/$daba;charset=utf8 ,$user ,$pass";
            //echo "$stringconex <br>"; 
            $base= new PDO("oci:dbname=$host/$daba;charset=utf8" ,$user ,$pass);
            $checar=1;
        }catch(PDOException $e){
             //echo "SE ENCONTRO EL SIGUINETE ERROR"+ $e->getMessage( );
             $checar=0;
        }
        return $checar; 
    }

    public function ProbarConexionbdlink($dblink){
        $checar=0; 
       
        $sql = "SELECT 1 AS coneA  FROM DUAL@ ".$dblink."";

        echo "$sql <br>"; 
       //$stmt = oci_parse($this->con2, $sql);
       //$conex= oci_execute($stmt);
       //if($conex){
       //    $checar=1; 
       //    //$this->cerrarConexiondblink($dblink);
       //}
       //return $checar;   
    }

    public function cerrarConexiondblink($dblink){
        //$sql = "COMMIT";
        //$sql = "ROLLBACK";
        //$sql="ALTER SESSION CLOSE DATABASE LINK $dblink";
        //$sql="EXECUTE DBMS_SESSION.CLOSE_DATABASE_LINK ($dblink)";
        $sql="ALTER SESSION SET SESSION_CACHED_CURSORS = 0; "; 
        $sql.="DBMS_SESSION.CLOSE_DATABASE_LINK ('$dblink')"; 
        $sql.="ALTER SESSION SET SESSION_CACHED_CURSORS = 50; "; 
        echo "$sql <br>"; 
        //$stmt = oci_parse($this->con2, $sql);
        //$conex= oci_execute($stmt);
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