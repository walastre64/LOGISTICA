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

$txt_id_saint_banco 	= sanear_string($_POST['txt_id_saint_banco']);
$txt_nombre_banco		= sanear_string($_POST['txt_nombre_banco']);
$txt_codigo_banco		= sanear_string($_POST['txt_codigo_banco']);
$txt_codigo_Saint		= sanear_string($_POST['txt_codigo_Saint']);
$txt_codemp				= sanear_string($_POST['txt_codemp']);
$txt_ctaban				= sanear_string($_POST['txt_ctaban']);
$txt_ctabanext			= sanear_string($_POST['txt_ctabanext']);
$txt_dencta				= sanear_string($_POST['txt_dencta']);
$cbo_sc_cuenta			= sanear_string($_POST['cbo_sc_cuenta']);
$cbo_status				= sanear_string($_POST['cbo_status']);

$valor_consulta = 0;

$qry  =  "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_ALM_SAINT_BANCO] ";
$qry .=    "".$txt_id_saint_banco."";
$qry .=  ",'".$txt_nombre_banco."'";
$qry .=  ",'".$txt_codigo_banco."'";
$qry .=  ",'".$txt_codigo_Saint."'";
$qry .=  ",'".$txt_codemp."'";
$qry .=  ",'".$txt_ctaban."'";
$qry .=  ",'".$txt_ctabanext."'";
$qry .=  ",'".$txt_dencta."'";
$qry .=  ",'".$cbo_sc_cuenta."'";
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
