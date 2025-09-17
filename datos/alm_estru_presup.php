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

$txt_id_estru_presu 		= sanear_string($_POST['txt_id_estru_presu']);
$cbo_id_programa_detalle	= sanear_string($_POST['cbo_id_programa_detalle']);
$txt_codestpro1		 		= sanear_string($_POST['txt_codestpro1']);
$txt_codestpro2		 		= sanear_string($_POST['txt_codestpro2']);
$txt_codestpro3		 		= sanear_string($_POST['txt_codestpro3']);
$txt_codestpro4		 		= sanear_string($_POST['txt_codestpro4']);
$txt_codestpro5		 		= sanear_string($_POST['txt_codestpro5']);
$cbo_estcla				 	= sanear_string($_POST['cbo_estcla']);
$cbo_periodo			 	= sanear_string($_POST['cbo_periodo']);

$valor_consulta = 0;

$qry  =  "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_ALM_ESTRU_PRESP] ";
$qry .=    "".$txt_id_estru_presu."";
$qry .=  ",'".$cbo_id_programa_detalle."'";
$qry .=  ",'".$txt_codestpro1."'";
$qry .=  ",'".$txt_codestpro2."'";
$qry .=  ",'".$txt_codestpro3."'";
$qry .=  ",'".$txt_codestpro4."'";
$qry .=  ",'".$txt_codestpro5."'";
$qry .=  ",'".$cbo_estcla."'";
$qry .=  ",'".$cbo_periodo."'";
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
