<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE'); # Localiza en español es_Venezuela
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
// ------------------------------------------------->
session_valida();
$conn = conectate();

$txt_id_programa		= sanear_string($_POST['txt_id_programa']);
$txt_nombre_programa	= sanear_string($_POST['txt_nombre_programa']);
$txt_codigo_interno		= sanear_string($_POST['txt_codigo_interno']);
$txt_status				= sanear_string($_POST['txt_status']);

$valor_consulta = 0;

$qry  =  "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_ALM_PROGRAMA] ";
$qry .=    "".$txt_id_programa."";
$qry .=  ",'".$txt_nombre_programa."'";
$qry .=  ",'".$txt_codigo_interno."'";
$qry .=  ",'".$txt_status."'";
$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
if (! $rst) {  
   echo "Error en la ejecución de la instrucción ".$qry.".\n";
   die( print_r2( sqlsrv_errors(), true));
   exit;
}else{
	while( $rowsu = sqlsrv_fetch_array($rst)){
		
		$valor_consulta = $rowsu[0]; // 0 error de coexion - 1 nuevo - 2 actualizo - 3 codigo_interno utilizado
	}
} 
sqlsrv_free_stmt( $rst );  
sqlsrv_close( $conn );  

echo $valor_consulta;
?>
