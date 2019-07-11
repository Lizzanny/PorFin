<?php
/*function inverse($x) {
    if (!$x) {
        throw new Exception('División por cero.');
    }
    return 1/$x;
}

try {
    echo inverse(0) . "\n";
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
} finally {
    echo "Primer finally.\n";
}

try {
    echo inverse(0) . "\n";
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
} finally {
    echo "Segundo finally.\n";
}

// Continuar ejecución
echo 'Hola Mundo\n';*/
include_once '../../Libs/conexionOracle.php';
function verificaConexion($dblinki){
        $vaco = 0;
        $sql = "SELECT 1 AS coneA FROM DUAL@".$dblinki;
        //echo"$sql";
        $stmt = oci_parse($con2, $sql);

        if(!oci_execute($stmt)){
            throw new Exception('División por cero.');
        }   
        return 1;
        
        
    }

    try{
            
            echo verificaConexion('ACT_GMX.WORLD');
            //return "Verdadero";
            } 
        
        catch(Exception $e){
            echo "falso";
        }
?>