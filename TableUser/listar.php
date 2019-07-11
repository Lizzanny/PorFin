<?php 
	/**
	 * 
	 */
	include_once '../Libs/conexionOracle.php';//Incluimos la conexion
	class Listar extends ConexionOracle{

		//atributos 
		

		//constructor
		
		
		//metodos
		public function generaLista(){
			$array["data"] = [];
			$msj = 'No se encuentra información.';
			$opc = 2;

			$sql = "SELECT USR_USUARIOS.CENCOS_CT_CLAVE, USR_USUARIOS.CENCOS_CLAVE, USR_USUARIOS.USR_NOMBRE, 
					USR_USUARIOS.RH_CENTRAB, NVL(USR_USUARIOS.RH_NUMNOMINA, 0)AS RH_NUMNOMINA, USR_USUARIOS.USUARIO, USR_USUARIOS.USR_PASSW,
					USR_ROLES.ROL_NAME, USR_ROLES.ROL_MODULO
					FROM USR_USUARIOROL
					INNER JOIN USR_USUARIOS
					ON USR_USUARIOROL.USUARIO = USR_USUARIOS.USUARIO
					INNER JOIN USR_ROLES
					ON USR_ROLES.ROL_NAME = USR_USUARIOROL.ROL_NAME
					WHERE (USR_ROLES.ROL_NAME = 'RFINPRESUP' OR USR_ROLES.ROL_NAME = 'RFINCONTABLE') AND USR_USUARIOS.USR_ACTIVO = 1";
	
			$stmt = oci_parse($this->conO, $sql);

			 oci_execute($stmt);
			 for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){ 
				$array["data"][] = array(
										'ctxcco' => $row['CENCOS_CT_CLAVE'],  
		                                'cvecco' => $row['CENCOS_CLAVE'],
		                                'usrnom' => $row['USR_NOMBRE'],  
		                                'rhctra' => $row['RH_CENTRAB'],
		                                'rhnnna' => $row['RH_NUMNOMINA'],  
		                                'usuari' => $row['USUARIO'],
		                                'usrpas' => $row['USR_PASSW'],  
		                                'rolnam' => $row['ROL_NAME'],
		                                'rolmod' => $row['ROL_MODULO']
		                              );
			 }
				echo json_encode($array); 
				oci_free_statement($stmt);
        	
			}
				

	}//endmyclass

	$obj = new Listar();//instancia de la clase para crear un obj

//llamar un metodo de la la clase 
	$obj->generaLista();
	$obj->cerrarConexion(); 

 ?>

