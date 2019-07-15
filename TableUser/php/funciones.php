<?php 

include_once '../../Libs/conexionOracle.php';
class UserFunctions extends ConexionOracle{
	private $cve_user=11101010; 


	
	function __construct(){
		parent::__construct();
	}

	public function obtnerDatosUsuari(){
		session_start();
		$this->cve_user = $_SESSION['username']; 
	}


	public function getCT(){
		$lista='';
		$sql = "SELECT CT_CLAVE, CT_DESCR FROM CENTROS_TRABAJO";
	
		$stmt = oci_parse($this->conO, $sql);

		oci_execute($stmt);

		$lista.='<option selected="selected">SELECCIONA UN CENTRO DE TRABAJO</option>';
		for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){
			$lista.="<option value='$row[0]'> $row[1] </option>";
		}
			 
		oci_free_statement($stmt);
		echo $lista;
        
	}
	
	public function getCC($cvecct){
		$lista='';
		$sql = "SELECT CENCOS_CLAVE, DESCRIPCION FROM CENTROS_COSTO WHERE CENCOS_CT_CLAVE = '$cvecct'";
	
		$stmt = oci_parse($this->conO, $sql);

		oci_execute($stmt);

		$lista.='<option selected="selected">SELECCIONA UN CENTRO DE COSTO</option>';
		for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){
			$lista.="<option value='$row[0]'> $row[1] </option>";
		}
			 
		oci_free_statement($stmt);
		echo $lista;
        
	}		

	public function getName($rhctno,$nomina){
		$lista='';
		$sql = "SELECT RH_ME_NOMCTO FROM RH_MTROEMP WHERE RH_ME_CENTRAB ='$rhctno' AND RH_ME_NUMNOMI ='$nomina' ";
	
		$stmt = oci_parse($this->conO, $sql);

		oci_execute($stmt);

		$row = oci_fetch_array($stmt, OCI_BOTH);
		$lista = $row['RH_ME_NOMCTO'];
		 
		oci_free_statement($stmt);
		echo $lista;
        
	}

	public function saveUser($ccoct, $cvecc, $nunna, $nomus, $usuar, $passw, $cvero){

		$msj = '¡Error! No ha sido posible registrar a este usuario.';
		$opc = 2;
		$array = array();

		if($this->verificaUser($nunna) == '1'){
			$sql1 = "INSERT INTO USR_USUARIOS(USUARIO, USR_PASSW, USR_NOMBRE, CENCOS_CT_CLAVE, CENCOS_CLAVE, USR_ACTIVO, RH_CENTRAB, RH_NUMNOMINA) 
				VALUES('$usuar', '$passw', '$nomus', $ccoct, $cvecc, 1, $ccoct, $nunna)";

			$stmt1 = oci_parse($this->conO, $sql1);
			oci_execute($stmt1);
			$cont = oci_num_rows($stmt1);
			if($stmt1){
				//$this->usrRol($usuar, $cvero);
				//
				$sql = "INSERT INTO USR_USUARIOROL (USUARIO, ROL_NAME) VALUES ('$usuar', '$cvero')";
				$stmt = oci_parse($this->conO, $sql);
				oci_execute($stmt);
		
				//$cont = oci_num_rows($stmt);
				if($stmt){
					$msj = '¡Exito! Se ha agregado correctamente al usuario.';
					$opc = 1;
				}else{
					$msj = 'Sucedio un error al intentar agregar un usuario';
					$opc = 2;
				}
				
		
				$array = array('msj' => $msj,
								'opc' => $opc );
		
				echo json_encode($array);
			}else{
				$msj = '¡Error! No ha sido posible registrar a este usuario.';
				$opc = 2;
				$array = array('msj' => $msj,
						'opc' => $opc );

				echo json_encode($array);
			}

		}else{
			$msj = '¡Atención! Esta intentando agregar un usuario que ya existe.';
			$opc = 3;

			$array = array('msj' => $msj,
						'opc' => $opc );

			echo json_encode($array);
		}

		
	}

	public function verificaUser($nunna){
		$sql = "SELECT * FROM USR_USUARIOS WHERE RH_NUMNOMINA = '$nunna'";
		$stmt = oci_parse($this->conO, $sql);
		oci_execute($stmt);
		//echo $sql.'<br>';
		//echo 'existen usuarios'.
		$res = oci_num_rows($stmt);
		if($res == 0){
			return '1';
		}
			return '2';
	}

	public function usrRol($usuar, $cvero){
		$msj = 'Sucedio un error al intentar agregar un usuario';
		$opc = 2;
		$array = array();
		
		$sql = "INSERT INTO USR_USUARIOROL (USUARIO, ROL_NAME) VALUES ('$usuar', '$cvero')";
		$stmt = oci_parse($this->conO, $sql);
		oci_execute($stmt);

		//$cont = oci_num_rows($stmt);
		if($stmt){
			$msj = '¡Exito! Se ha agregado correctamente al usuario.';
			$opc = 1;
		}else{
			$msj = 'Sucedio un error al intentar agregar un usuario';
			$opc = 2;
		}
		

		$array = array('msj' => $msj,
						'opc' => $opc );

		echo json_encode($array);
	}

	public function returnCT($clavec){
		$lista='';
		$sql = "SELECT CT_CLAVE, CT_DESCR FROM CENTROS_TRABAJO";
	
		$stmt = oci_parse($this->conO, $sql);

		oci_execute($stmt);

		for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){
			if($row[0]==$clavec){
				$lista="<option value='$row[0]' selected='selected'> $row[1] </option>";
			}
			$lista.="<option value='$row[0]'> $row[1] </option>";
		}
			 
		oci_free_statement($stmt);
		echo $lista;
        
	}

	public function returnCCos($clavec, $claves){
		$lista='';
		$sql = "SELECT CENCOS_CLAVE, DESCRIPCION FROM CENTROS_COSTO WHERE CENCOS_CT_CLAVE = '$clavec'";
	
		$stmt = oci_parse($this->conO, $sql);

		oci_execute($stmt);

		for ($i=0; $row = oci_fetch_array($stmt, OCI_BOTH); $i++){
			if($row[0]==$claves){
				$lista="<option value='$row[0]' selected='selected'> $row[1] </option>";
			}
			$lista.="<option value='$row[0]'> $row[1] </option>";
		}
			 
		oci_free_statement($stmt);
		echo $lista;
        
	}

	public function updateUser($ccoctx, $cveccx, $nunnax, $nomusx, $usuarx, $passwx, $cverox){
		$msj = '¡Error! No ha sido posible actualizar a este usuario.';
		$opc = 2;
		$array = array();
		$sql1 = "UPDATE USR_USUARIOS
					SET USR_PASSW = '$passwx',
						USR_NOMBRE = '$nomusx',
    					CENCOS_CT_CLAVE = '$ccoctx',
    					CENCOS_CLAVE = '$cveccx',
    					RH_CENTRAB = '$ccoctx',
    					RH_NUMNOMINA = '$nunnax'
				WHERE USUARIO = '$usuarx'";

			$stmt1 = oci_parse($this->conO, $sql1);
			oci_execute($stmt1);
			$cont = oci_num_rows($stmt1);
			if($cont != 0){
				$msj = 'Se han actualizado correctamente los datos del usuario.';
				$opc = 1;
			}

		$array = array('msj' => $msj,
						'opc' => $opc );

			echo json_encode($array);
	}

	public function inhabilite($usuari){
		$msj = '¡Error! No ha sido posible dar de baja a este usuario.';
		$opc = 2;
		$array = array();
		$sql1 = "UPDATE USR_USUARIOS
					SET USR_ACTIVO = 0
				WHERE USUARIO = '$usuari'";

			$stmt1 = oci_parse($this->conO, $sql1);
			oci_execute($stmt1);
			$cont = oci_num_rows($stmt1);
			if($cont != 0){
				$msj = 'Se ha dado de baja el usuario.';
				$opc = 1;
			}

		$array = array('msj' => $msj,
						'opc' => $opc );

			echo json_encode($array);
	}

}//end class


	$opc = $_POST['opcion'];
	$ob = new UserFunctions(); 
	$ob->obtnerDatosUsuari();
	switch ($opc) {
		//---------------------------operaciones para grupos
		case 'getCT':
			$ob->getCT();
		break;

		case 'getCC':
			$ob->getCC($_POST['cvecct']);
		break;

		case 'getName':
			$ob->getName($_POST['rhctno'], $_POST['nomina']);
		break;

		case 'saveUser':
			$ob->saveUser($_POST['ccoctx'], $_POST['cveccx'], $_POST['nunnax'], $_POST['nomusx'], $_POST['usuarx'], $_POST['passwx'], $_POST['cverox']);//101, 820, 9309, 'LIZETH VIVIANA MARTINEZ GOMEZ', 'PELUCHITO', '12345', 'RFINPRESUP');
		break;

		case 'returnCT':
			$ob->returnCT($_POST['clavec']);
		break;

		case 'returnCCos':
			$ob->returnCCos($_POST['clavec'],$_POST['claves']);
		break;

		case 'updateUser':
			$ob->updateUser($_POST['ccoctx'], $_POST['cveccx'], $_POST['nunnax'], $_POST['nomusx'], $_POST['usuarx'], $_POST['passwx'], $_POST['cverox']);//101, 820, 9309, 'LIZETH VIVIANA MARTINEZ GOMEZ', 'PELUCHITO', '12345', 'RFINPRESUP');
		break;

		case 'inhabilite':
			$ob->inhabilite($_POST['usuari']);
		break;

		default:
			echo "error no se encuentra la opcion";
			break;
	}

 ?>
