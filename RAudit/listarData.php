<?php 
    /**
     * 
     */
    include_once '../Libs/conexionOracle.php';//Incluimos la conexion
    class ListarData extends ConexionOracle{
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

            $sql = "SELECT CUENTA, CENTRO_TRABAJO, CEDULA, ACTIVO, CONTCC, CONTSC, CONTSSC, CONTSSSC, CONTDES, CONTFECHADQ, CONTFACTURA, CONTCOSTO,CONTORIGBIEN, CONTASADEP, CONTFECHCAP, CONTFECHDEP, CONTPOLIZA, CONTREFALTAS, CONTREFBAJAS, CONTABONO, CONTFECHMOV, CONTDEPMEN, CONTDEPANUAL, CONTDEPACUM, CONTSALXDEP, CONTBAJADEP, CONTMESDEP, CONTFECHDETDEP, CONTFECHBAJA FROM INFOAUDITORIA";
    
            $stmt = oci_parse($this->con2, $sql);
            oci_execute($stmt);
            for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){ 
               
                $array["data"][] = array(
                                'num' => ($i+1),
                                'cta' => $row['CUENTA'],
                                'ctx' => $row['CENTRO_TRABAJO'],
                                'ced' => $row['CEDULA'],
                                'act' => $row['ACTIVO'],
                                'tcc' => $row['CONTCC'],
                                'tsc' => $row['CONTSC'],
                                'ssc' => $row['CONTSSC'],
                                'sss' => $row['CONTSSSC'],
                                'des' => $row['CONTDES'],
                                'adq' => $row['CONTFECHADQ'],
                                'ura' => $row['CONTFACTURA'],
                                'sto' => $row['CONTCOSTO'],
                                'ien' => $row['CONTORIGBIEN'],
                                'dep' => $row['CONTASADEP'],
                                'cap' => $row['CONTFECHCAP'],
                                'chd' => $row['CONTFECHDEP'],
                                'iza' => $row['CONTPOLIZA'],
                                'tas' => $row['CONTREFALTAS'],
                                'jas' => $row['CONTREFBAJAS'],
                                'ono' => $row['CONTABONO'],
                                'mov' => $row['CONTFECHMOV'],
                                'men' => $row['CONTDEPMEN'],
                                'ual' => $row['CONTDEPANUAL'],
                                'cum' => $row['CONTDEPACUM'],
                                'xde' => $row['CONTSALXDEP'],
                                'ade' => $row['CONTBAJADEP'],
                                'sde' => $row['CONTMESDEP'],
                                'tde' => $row['CONTFECHDETDEP'],
                                'hba' => $row['CONTFECHBAJA']
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
    $obj = new ListarData();//instancia de la clase para crear un obj
//llamar un metodo de la la clase 
    $obj->cerrarConexion(); 
 ?>
