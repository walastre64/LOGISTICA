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

$txt_id_aso_contab_presup 	= sanear_string($_POST['txt_id_aso_contab_presup']);
$txt_codinst				= sanear_string($_POST['txt_codinst']);
$txt_descrip				= sanear_string($_POST['txt_descrip']);
$cbo_servicio_producto		= sanear_string($_POST['cbo_servicio_producto']);
$cbo_id_cta_contable		= sanear_string($_POST['cbo_id_cta_contable']);
$cbo_id_partida				= sanear_string($_POST['cbo_id_partida']);
$cbo_id_bd					= sanear_string($_POST['cbo_id_bd']);
$cbo_codinst_ppal			= sanear_string($_POST['cbo_codinst_ppal']);
$cbo_activo					= sanear_string($_POST['cbo_activo']);

$valor_consulta = 0;

$qry  =  "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_ALM_ASO_CONTAB_PRESUP_INSTA] ";
$qry .=    "".$txt_id_aso_contab_presup."";
$qry .=  ",'".$txt_codinst."'";
$qry .=  ",'".$txt_descrip."'";
$qry .=  ",'".$cbo_servicio_producto."'";
$qry .=  ",'".$cbo_id_cta_contable."'";
$qry .=  ",'".$cbo_id_partida."'";
$qry .=  ",'".$cbo_id_bd."'";
$qry .=  ",'".$cbo_codinst_ppal."'";
$qry .=  ",'".$cbo_activo."'";

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
