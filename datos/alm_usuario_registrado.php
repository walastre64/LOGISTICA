<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE'); # Localiza en español es_Venezuela
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
//include('../restringir/restringir.ini.php');
// ------------------------------------------------->
//session_valida();
$conn = conectate();

$ip 			= getRealIP2();
$pc				= gethostbyaddr($_SERVER['REMOTE_ADDR']);

$txt_cedulaR	= sanear_string($_POST['txt_cedulaR']);
$txt_passwordR	= md5($_POST['txt_passwordR']);
$txt_email		= ($_POST['txt_email']);
$txt_nombreR	= sanear_string($_POST['txt_nombreR']);
$txt_apellidoR	= sanear_string($_POST['txt_apellidoR']);
$valor_consulta = 0;

$qry  =  "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC SP_ALM_USUARIOWEB ";
$qry .=    "".$txt_cedulaR."";
$qry .=  ",'".$txt_passwordR."'";
$qry .=  ",'".$txt_nombreR."'";
$qry .=  ",'".$txt_apellidoR."'";
$qry .=  ",'".$txt_email."'";
$qry .=  ",'".$ip."'";
$qry .=  ",'".$pc."'";

//*******************************************************************
// asignacion de ROL por defecto 0 y grupo 0 ************************
//*******************************************************************	
//echo $qry;

$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));

if (! $rst) {
   echo "Error en la ejecución de la instrucción ".$qry.".\n";
   die( print_r2( sqlsrv_errors(), true)); 
   exit;
}else{
	while( $row = sqlsrv_fetch_array( $rst, SQLSRV_FETCH_NUMERIC) ) {
     $valor_consulta = $row[0];
	}

}
sqlsrv_free_stmt( $rst );
sqlsrv_close( $conn );

echo $valor_consulta;
?>