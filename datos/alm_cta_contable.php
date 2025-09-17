<?PHP
header("Content-Type: text/html;charset=utf-8");
//header('Content-Type: text/html; charset=iso-8859-1')
setlocale(LC_TIME, 'es_VE'); # Localiza en español es_Venezuela
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
// ------------------------------------------------->
session_valida();
$conn = conectate();

$txt_id_cta					= sanear_string($_POST['txt_id_cta']);
$txt_cta_contable			= sanear_string($_POST['txt_cta_contable']);
$txt_descrip_cta_contable	= ($_POST['txt_descrip_cta_contable']);
$cbo_periodo				= sanear_string($_POST['cbo_periodo']);
$txt_status					= sanear_string($_POST['txt_status']);
//$txt_tipo					= sanear_string($_POST['txt_tipo']);

$valor_consulta = 0;

$qrye  = "[SP_ALM_CTA_CONTABLE] ";
$qrye .= "" .$txt_id_cta."";
$qrye .= ",'".$txt_cta_contable."'";
$qrye .= ",'".$txt_descrip_cta_contable."'";
$qrye .= ",".$cbo_periodo."";
$qrye .= ",".$txt_status."";
//$qrye .= ",".$txt_tipo."";
$rst = sqlsrv_query( $conn, $qrye, array(), array("Scrollable"=>"buffered"));
if (! $rst) {
   echo "Error en la ejecución de la instrucción ".$qrye.".\n";
   die( print_r2( sqlsrv_errors(), true)); 
   exit;
}else{
	while( $row = sqlsrv_fetch_array( $rst, SQLSRV_FETCH_NUMERIC) ) {
     $valor_consulta  = $row[0].'/';
	 $valor_consulta .= $row[1];
	}

}
echo $valor_consulta."/".$qrye;

sqlsrv_free_stmt( $rst );
sqlsrv_close( $conn );
?>
