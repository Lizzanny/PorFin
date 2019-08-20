<?php 
    /**
     * 
     */
    include_once '../Libs/conexionOracle.php';//Incluimos la conexion
    class ListarDispo extends ConexionOracle{
        function __construct(){
            parent::__construct();
          $this->getMetodoAcceso();
        }
        
        //metodos
        public function generaLista(){
            $array["data"] = [];
            $msj = 'No se encuentra información.';
            $opc = 2;
            $bot = [];
      $che = [];
            $estado_color = array(
                '0' => '../Libs/image/rojo.png',
                '1' => '../Libs/image/verde.png',
                '2' => '../Libs/image/blanco.png');
            $sql = "SELECT CT_CLAVE, DB_NAME, DB_INSTANCE, USUARIO, CLAVE, IP, SID FROM C_DBLINKS";
    
            $stmt = oci_parse($this->con2, $sql);
            oci_execute($stmt);
            for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){ 
                 //llamar al metodo comprobar conexion de las base de datos remotos
                $host= trim($row["IP"]);
                $base= trim($row["SID"]);
                $user= trim($row["USUARIO"]);
                $pass= trim($row["CLAVE"]);
                $nomb= trim($row["DB_INSTANCE"]);
                $dblink= trim($row["DB_NAME"]);
            
               $conex = 2;
              $bot[$i] = "<img width='30px' id='images".$row['CT_CLAVE']."'  name='images".$row['CT_CLAVE']."' src='".$estado_color[$conex]."'>";
              $che[$i] = "<button type='button' class='checarCon btn btn btn-info btn-sm' id='checkin".$row['CT_CLAVE']."' name='checkin".$row['CT_CLAVE']."'><i class='far fa-check-square'></i></button>";
               
                $array["data"][] = array(
                          'num' => ($i+1),
                          'clve' => $row['CT_CLAVE'],
                                          'nomb' => $row['DB_INSTANCE'],
                                          'cone' => $bot[$i],
                          'chec' => $che[$i]
                                         );           
                                   
             }
                echo json_encode($array); 
                oci_free_statement($stmt);
            
            }
            public function getMetodoAcceso(){
                $this->generaLista(); 
       
                //echo json_encode($this->cnx); 
            }
                
    }//endmyclass
    $obj = new ListarDispo();//instancia de la clase para crear un obj
//llamar un metodo de la la clase 
    $obj->cerrarConexion(); 
 ?>
