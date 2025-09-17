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

$txt_id_programa_detalle = sanear_string($_POST['txt_id_programa_detalle']);
$txt_nombre_detalle		 = sanear_string($_POST['txt_nombre_detalle']);
$cbo_id_programa		 = sanear_string($_POST['cbo_id_programa']);
$cbo_id_bd				 = sanear_string($_POST['cbo_id_bd']);
$cbo_id_sucu			 = sanear_string($_POST['cbo_id_sucu']);
$cbo_cta_ingreso		 = sanear_string($_POST['cbo_cta_ingreso']);
$cbo_cta_debito_fiscal	 = sanear_string($_POST['cbo_cta_debito_fiscal']);
$cbo_status				 = sanear_string($_POST['cbo_status']);

$valor_consulta = 0;

$qry  =  "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_ALM_PROGRAMA_DETALLE] ";
$qry .=    "".$txt_id_programa_detalle."";
$qry .=  ",'".$txt_nombre_detalle."'";
$qry .=  ",'".$cbo_id_programa."'";
$qry .=  ",'".$cbo_id_bd."'";
$qry .=  ",'".$cbo_id_sucu."'";
$qry .=  ",'".$cbo_cta_ingreso."'";
$qry .=  ",'".$cbo_cta_debito_fiscal."'";
$qry .=  ",'".$cbo_status."'";
$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
if (! $rst) {  
   echo "Error en la ejecución de la instrucción ".$qry.".\n";
   die( print_r2( sqlsrv_errors(), true));
   exit;
}else{
	while( $rowsu = sqlsrv_fetch_array($rst)){
		
		$valor_consulta = $rowsu[0]; // 0 error de coexion - 1 nuevo - 2 actualizo
	}
} 
sqlsrv_free_stmt( $rst );  
sqlsrv_close( $conn );  

echo $valor_consulta;
?>
