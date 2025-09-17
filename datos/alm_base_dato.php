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

$txt_id_bd			= sanear_string($_POST['txt_id_bd']);
$txt_nombre_bd		= sanear_string($_POST['txt_nombre_bd']);
$txt_ruta_bd		= sanear_string($_POST['txt_ruta_bd']);
$txt_status			= sanear_string($_POST['txt_status']);
$txt_tipo			= sanear_string($_POST['txt_tipo']);
$txt_codigo_serie	= sanear_string($_POST['txt_codigo_serie']);
$txt_descripcion_bd = sanear_string($_POST['txt_descripcion_bd']);
$cbo_id_sistema		= sanear_string($_POST['cbo_id_sistema']);


$valor_consulta = 0;

$qry  =  "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC SP_ALM_BASE_DATO ";
$qry .=    "".$txt_id_bd."";
$qry .=  ",'".$txt_ruta_bd."'";
$qry .=  ",'".$txt_nombre_bd."'";
$qry .=  ",'".$txt_status."'";
$qry .=  ",'".$txt_tipo."'";
$qry .=  ",'".$txt_codigo_serie."'";
$qry .=  ",'".$txt_descripcion_bd."'";
$qry .=  ",'".$cbo_id_sistema."'";

$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
if (! $rst) {  
   echo "Error en la ejecución de la instrucción ".$qry.".\n";
   die( print_r2( sqlsrv_errors(), true));  
   exit;
}else{
	$valor_consulta = 1;
} 
sqlsrv_free_stmt( $rst );  
sqlsrv_close( $conn );  

echo $valor_consulta;

?>
