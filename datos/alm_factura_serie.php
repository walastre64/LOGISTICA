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

$txt_id_serie 				= sanear_string($_POST['txt_id_serie']);
$cbo_descripcion_bd			= sanear_string($_POST['cbo_descripcion_bd']);
$cbo_id_programa_detalle	= sanear_string($_POST['cbo_id_programa_detalle']);
$cbo_tipo_impresora			= sanear_string($_POST['cbo_tipo_impresora']);
$txt_sigla_serie			= sanear_string($_POST['txt_sigla_serie']);
$txt_codigo_impresoraF		= sanear_string($_POST['txt_codigo_impresoraF']);
$txt_cod_vendedor			= sanear_string($_POST['txt_cod_vendedor']);
$txt_cod_ubicacion			= sanear_string($_POST['txt_cod_ubicacion']);
$txt_cod_operacion			= sanear_string($_POST['txt_cod_operacion']);
$txt_codigo_Serie			= sanear_string($_POST['txt_codigo_Serie']);
$cbo_status					= sanear_string($_POST['cbo_status']);

$valor_consulta = 0;

$qry  =  "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_ALM_FACTURA_SERIE] ";
$qry .=    "".$txt_id_serie."";
$qry .=  ",'".$cbo_descripcion_bd."'";
$qry .=  ",'".$cbo_id_programa_detalle."'";
$qry .=  ",'".$cbo_tipo_impresora."'";
$qry .=  ",'".$txt_sigla_serie."'";
$qry .=  ",'".$txt_codigo_impresoraF."'";
$qry .=  ",'".$txt_cod_vendedor."'";
$qry .=  ",'".$txt_cod_ubicacion."'";
$qry .=  ",'".$txt_cod_operacion."'";
$qry .=  ",'".$txt_codigo_Serie."'";
$qry .=  ",'".$cbo_status."'";
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
