<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'CEDULAS, ACTIVOS';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'CUENTA', 'dt' => 0 ),
    array( 'db' => 'CENTRO_TRABAJO',  'dt' => 1 ),
    array( 'db' => 'CEDULA',   'dt' => 2 ),
    array( 'db' => 'NUMACTIVO',     'dt' => 3 ),
    array( 'db' => 'CONTCC', 'dt' => 4 ),
    array( 'db' => 'CONTSC',  'dt' => 5 ),
    array( 'db' => 'CONTSSC',   'dt' => 6 ),
    array( 'db' => 'CONTSSSC',     'dt' => 7 ),
    array( 'db' => 'CONTDES', 'dt' => 8 ),
    array( 'db' => 'CONTFECHADQ',  'dt' => 9 ),
    array( 'db' => 'CONTFACTURA',   'dt' => 10 ),
    array( 'db' => 'CONTCOSTO',     'dt' => 11 ),
    array( 'db' => 'CONTORIGBIEN', 'dt' => 12 ),
    array( 'db' => 'CONTASADEP',  'dt' => 13 ),
    array( 'db' => 'CONTFECHCAP',   'dt' => 14 ),
    array( 'db' => 'CONTFECHDEP',     'dt' => 15 ),
    array( 'db' => 'CONTPOLIZA', 'dt' => 16 ),
    array( 'db' => 'CONTREFALTAS',  'dt' => 17 ),
    array( 'db' => 'CONTREFBAJAS',   'dt' => 18 ),
    array( 'db' => 'CONTABONO',     'dt' => 19 ),
    array( 'db' => 'CONTFECHMOV', 'dt' => 20 ),
    array( 'db' => 'CONTDEPMEN',  'dt' => 21 ),
    array( 'db' => 'CONTDEPANUAL',   'dt' => 22 ),
    array( 'db' => 'CONTDEPACUM',     'dt' => 23 ),
    array( 'db' => 'CONTSALXDEP', 'dt' => 24 ),
    array( 'db' => 'CONTBAJADEP',  'dt' => 25 ),
    array( 'db' => 'CONTMESDEP',   'dt' => 26 ),
    array( 'db' => 'CONTFECHDETDEP',  'dt' => 27 ),
    array( 'db' => 'CONTFECHBAJA',   'dt' => 28 ),

    array(
        'db'        => 'start_date',
        'dt'        => 29,
        'formatter' => function( $d, $row ) {
            return date( 'jS M y', strtotime($d));
        }
    ),
    array(
        'db'        => 'salary',
        'dt'        => 30,
        'formatter' => function( $d, $row ) {
            return '$'.number_format($d);
        }
    )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'PORFINAN',
    'pass' => 'porfinan',
    'db'   => 'actfij',
    'host' => '172.30.10.98'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
?>