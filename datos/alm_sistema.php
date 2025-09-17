<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE'); # Localiza en español es_Venezuela
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
// ------------------------------------------------->
session_valida();
$conn 		= conectate();
$usuario 	= $_SESSION['id'];

$txt_id_sistema		= sanear_string($_POST['txt_id_sistema']);
$txt_sistema		= sanear_string($_POST['txt_sistema']);
$cbo_status			= sanear_string($_POST['cbo_status']);


$valor_consulta = 0;

$qry  =  "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC SP_ALM_SISTEMA ";
$qry .=    "".$txt_id_sistema."";
$qry .=  ",'".$txt_sistema."'";
$qry .=  ",'".$cbo_status."'";
$qry .=  ",'".$usuario."'";


$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
if (! $rst) {
   echo "Error en la ejecución de la instrucción ".$qry.".\n";
   die( print_r2( sqlsrv_errors(), true));
   exit;
}else{
	while( $rowsu = sqlsrv_fetch_array($rst)){
		
		$valor_consulta = $rowsu[0]; // 0 error de conexion - 1 nuevo - 2 actualizo
	}
} 
sqlsrv_free_stmt( $rst );
sqlsrv_close( $conn );

echo $valor_consulta;
?>