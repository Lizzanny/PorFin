<?php 
	/**
	 * 
	 */
	include_once '../../Libs/conexionOracle.php';//Incluimos la conexion
	class Login extends ConexionOracle{
		private $user;
		private $pass;

		function __construct($user, $pass){//Constructor
			parent::__construct();
			$this->user = $user;
			$this->pass = $pass;
		}
//////////////////////////////////////////////metodos
		public function validarUsuario(){
			$msj = 'Contraseña o Usuario no coniciden vueva a intentar';
			$opc = 2;

			$sql = "SELECT USR_USUARIOS.USR_NOMBRE, USR_USUARIOROL.ROL_NAME, USR_USUARIOS.CENCOS_CT_CLAVE, USR_USUARIOS.CENCOS_CLAVE  FROM USR_USUARIOS
					INNER JOIN USR_USUARIOROL
					ON USR_USUARIOROL.USUARIO = USR_USUARIOS.USUARIO
					WHERE USR_USUARIOS.USUARIO = '$this->user' AND USR_USUARIOS.USR_PASSW = '$this->pass' AND (USR_USUARIOROL.ROL_NAME='RFINPRESUP' OR USR_USUARIOROL.ROL_NAME='RFINCONTABLE' OR USR_USUARIOROL.ROL_NAME='RFINADM')";
			//echo $sql."<br>";
			$stmt = oci_parse($this->conO, $sql);

			oci_execute($stmt);
			//$nrows = oci_fetch_all($stmt, $res);
			//oci_num_rows($stmt)
			
			
			$rowx = oci_fetch_array($stmt, OCI_BOTH);
			if($rowx){
				$opc = 1;
				$msj = "¡Bienvenido ".$rowx['USR_NOMBRE']."!";
				$this->variablesSesion($rowx);
			}
			
	
			oci_free_statement($stmt);
        	
			$userInfo = array('opc' => $opc,
						  	  'msj' => $msj
						);
			echo json_encode($userInfo); 
		} 

		public  function variablesSesion($row){
   			session_start();
   			$_SESSION['username'] = $row['USR_NOMBRE'];
   			$_SESSION['rol'] = $row['ROL_NAME'];
   			$_SESSION['ctx'] = $row['CENCOS_CT_CLAVE'];
   			$_SESSION['cco'] = $row['CENCOS_CLAVE'];
   		}
	}

	$obj = new Login($_POST['resu'], $_POST['ssap']);
	$opc = $_POST['opcion'];
	//$_POST['resu'], $_POST['ssap']);
	//$obj->cerrarConexion();
	switch ($opc) {
		case 'IniciaSesion':
			$obj->validarUsuario();
		break;

		default:
			echo "error no se encuentra la opcion";
		break;
	}
 ?>