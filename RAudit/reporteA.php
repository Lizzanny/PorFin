<?php
/**
 * Ejemplo de cómo usar PDO y PHPSpreadSheet para
 * exportar datos de MySQL a Excel de manera
 * fácil, rápida y segura
 *
 * @author parzibyte
 * @see https://parzibyte.me/blog/2019/02/14/leer-archivo-excel-php-phpspreadsheet/
 * @see https://parzibyte.me/blog/2018/02/12/mysql-php-pdo-crud/
 * @see https://parzibyte.me/blog/2019/02/16/php-pdo-parte-2-iterar-cursor-comprobar-si-elemento-existe/
 * @see https://parzibyte.me/blog/2018/11/08/crear-archivo-excel-php-phpspreadsheet/
 * @see https://parzibyte.me/blog/2018/10/11/sintaxis-corta-array-php/
 *
 */
require_once "../vendor/autoload.php";
# Nuestra base de datos
require_once "bd.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
# Obtener base de datos
$bd = obtenerBD();
$documento = new Spreadsheet();
ini_set("memory_limit","1024M");
$documento
    ->getProperties()
    ->setCreator("Luis Cabrera Benito (parzibyte)")
    ->setLastModifiedBy('Parzibyte')
    ->setTitle('Archivo exportado desde MySQL')
    ->setDescription('Un archivo de Excel exportado desde MySQL por parzibyte');
# Como ya hay una hoja por defecto, la obtenemos, no la creamos
$hojaDeProductos = $documento->getActiveSheet();
$hojaDeProductos->setTitle("Productos");
# Escribir encabezado de los productos
$encabezado = [ "CUENTA", "CENTRO_TRABAJO", "CEDULA", "ACTIVO", "CONTCC", "CONTSC", "CONTSSC", "CONTSSSC", "CONTDES", "CONTFECHADQ", "CONTFACTURA", "CONTCOSTO", "CONTORIGBIEN", "CONTASADEP", "CONTFECHCAP", "CONTFECHDEP", "CONTPOLIZA", "CONTREFALTAS", "CONTREFBAJAS", "CONTABONO", "CONTFECHMOV", "CONTDEPMEN", "CONTDEPANUAL", "CONTDEPACUM", "CONTSALXDEP", "CONTBAJADEP", "CONTMESDEP", "CONTFECHDETDEP", "CONTFECHBAJA"];
# El último argumento es por defecto A1 pero lo pongo para que se explique mejor
$hojaDeProductos->fromArray($encabezado, null, 'A1');
$consulta ="SELECT CUENTA, CENTRO_TRABAJO, CEDULA, ACTIVO, CONTCC, CONTSC, CONTSSC, CONTSSSC, CONTDES, CONTFECHADQ, CONTFACTURA, CONTCOSTO,CONTORIGBIEN, CONTASADEP, CONTFECHCAP, CONTFECHDEP, CONTPOLIZA, CONTREFALTAS, CONTREFBAJAS, CONTABONO, CONTFECHMOV, CONTDEPMEN, CONTDEPANUAL, CONTDEPACUM, CONTSALXDEP, CONTBAJADEP, CONTMESDEP, CONTFECHDETDEP, CONTFECHBAJA FROM INFOAUDITORIA";

 "select codigo, descripcion, precioCompra, precioVenta, existencia from productos";
$sentencia = $bd->prepare($consulta, [
    PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,
]);
$sentencia->execute();
# Comenzamos en la 2 porque la 1 es del encabezado
$numeroDeFila = 2;
while ($producto = $sentencia->fetchObject()) {
    # Obtener los datos de la base de datos
    $CUENTA = $producto->CUENTA;
    $CENTRO_TRABAJO = $producto->CENTRO_TRABAJO;
    $CEDULA = $producto->CEDULA;
    $ACTIVO = $producto->ACTIVO;
    $CONTCC = $producto->CONTCC;
    $CONTSC = $producto->CONTSC;
    $CONTSSC = $producto->CONTSSC;
    $CONTSSSC = $producto->CONTSSSC;
    $CONTDES = $producto->CONTDES;
    $CONTFECHADQ = $producto->CONTFECHADQ;
    $CONTFACTURA = $producto->CONTFACTURA;
    $CONTCOSTO = $producto->CONTCOSTO;
    $CONTORIGBIEN = $producto->CONTORIGBIEN;
    $CONTASADEP = $producto->CONTASADEP;
    $CONTFECHCAP = $producto->CONTFECHCAP;
    $CONTFECHDEP = $producto->CONTFECHDEP;
    $CONTPOLIZA = $producto->CONTPOLIZA;
    $CONTREFALTAS = $producto->CONTREFALTAS;
    $CONTREFBAJAS = $producto->CONTREFBAJAS;
    $CONTABONO = $producto->CONTABONO;
    $CONTFECHMOV = $producto->CONTFECHMOV;
    $CONTDEPMEN = $producto->CONTDEPMEN;
    $CONTDEPANUAL = $producto->CONTDEPANUAL;
    $CONTDEPACUM = $producto->CONTDEPACUM;
    $CONTSALXDEP = $producto->CONTSALXDEP;
    $CONTBAJADEP = $producto->CONTBAJADEP;
    $CONTMESDEP = $producto->CONTMESDEP;
    $CONTFECHDETDEP = $producto->CONTFECHDETDEP;
    $CONTFECHBAJA = $producto->CONTFECHBAJA;
  
    # Escribirlos en el documento
    $hojaDeProductos->setCellValueByColumnAndRow(1, $numeroDeFila, $CUENTA);
    $hojaDeProductos->setCellValueByColumnAndRow(2, $numeroDeFila, $CENTRO_TRABAJO);
    $hojaDeProductos->setCellValueByColumnAndRow(3, $numeroDeFila, $CEDULA);
    $hojaDeProductos->setCellValueByColumnAndRow(4, $numeroDeFila, $ACTIVO);
    $hojaDeProductos->setCellValueByColumnAndRow(5, $numeroDeFila, $CONTCC);
    $hojaDeProductos->setCellValueByColumnAndRow(6, $numeroDeFila, $CONTSC);
    $hojaDeProductos->setCellValueByColumnAndRow(7, $numeroDeFila, $CONTSSC);
    $hojaDeProductos->setCellValueByColumnAndRow(8, $numeroDeFila, $CONTSSSC);
    $hojaDeProductos->setCellValueByColumnAndRow(9, $numeroDeFila, $CONTDES);
    $hojaDeProductos->setCellValueByColumnAndRow(10, $numeroDeFila, $CONTFECHADQ);
    $hojaDeProductos->setCellValueByColumnAndRow(11, $numeroDeFila, $CONTFACTURA);
    $hojaDeProductos->setCellValueByColumnAndRow(12, $numeroDeFila, $CONTCOSTO);
    $hojaDeProductos->setCellValueByColumnAndRow(13, $numeroDeFila, $CONTORIGBIEN);
    $hojaDeProductos->setCellValueByColumnAndRow(14, $numeroDeFila, $CONTASADEP);
    $hojaDeProductos->setCellValueByColumnAndRow(15, $numeroDeFila, $CONTFECHCAP);
    $hojaDeProductos->setCellValueByColumnAndRow(16, $numeroDeFila, $CONTFECHDEP);
    $hojaDeProductos->setCellValueByColumnAndRow(17, $numeroDeFila, $CONTPOLIZA);
    $hojaDeProductos->setCellValueByColumnAndRow(18, $numeroDeFila, $CONTREFALTAS);
    $hojaDeProductos->setCellValueByColumnAndRow(19, $numeroDeFila, $CONTREFBAJAS);
    $hojaDeProductos->setCellValueByColumnAndRow(20, $numeroDeFila, $CONTABONO);
    $hojaDeProductos->setCellValueByColumnAndRow(21, $numeroDeFila, $CONTFECHMOV);
    $hojaDeProductos->setCellValueByColumnAndRow(22, $numeroDeFila, $CONTDEPMEN);
    $hojaDeProductos->setCellValueByColumnAndRow(23, $numeroDeFila, $CONTDEPANUAL);
    $hojaDeProductos->setCellValueByColumnAndRow(24, $numeroDeFila, $CONTDEPACUM);
    $hojaDeProductos->setCellValueByColumnAndRow(25, $numeroDeFila, $CONTSALXDEP);
    $hojaDeProductos->setCellValueByColumnAndRow(26, $numeroDeFila, $CONTBAJADEP);
    $hojaDeProductos->setCellValueByColumnAndRow(27, $numeroDeFila, $CONTMESDEP);
    $hojaDeProductos->setCellValueByColumnAndRow(28, $numeroDeFila, $CONTFECHDETDEP);
    $hojaDeProductos->setCellValueByColumnAndRow(29, $numeroDeFila, $CONTFECHBAJA);

    $numeroDeFila++;
}
# Ahora los clientes
# Ahora sí creamos una nueva hoja
$hojaDeClientes = $documento->createSheet();
$hojaDeClientes->setTitle("Clientes");
# Escribir encabezado
$encabezado = ["Nombre", "Correo electrónico"];
# El último argumento es por defecto A1 pero lo pongo para que se explique mejor
$hojaDeClientes->fromArray($encabezado, null, 'A1');
# Obtener clientes de BD
$consulta = "select nombre, correo from clientes";
$sentencia = $bd->prepare($consulta, [
    PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,
]);
//$sentencia->execute();
# Comenzamos en la 2 porque la 1 es del encabezado
$numeroDeFila = 2;
while ($cliente = $sentencia->fetchObject()) {
    # Obtener los datos de la base de datos
    $nombre = $cliente->nombre;
    $correo = $cliente->correo;
    # Escribirlos en el documento
    $hojaDeClientes->setCellValueByColumnAndRow(1, $numeroDeFila, $nombre);
    $hojaDeClientes->setCellValueByColumnAndRow(2, $numeroDeFila, $correo);
    $numeroDeFila++;
}
# Crear un "escritor"
$writer = new Xlsx($documento);
# Le pasamos la ruta de guardado
$writer->save('Exportado.xlsx');