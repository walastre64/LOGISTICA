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

$txt_id_sistema	= sanear_string($_POST['txt_id_sistema']);
$valor_consulta = 0;

$qry  =  "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_ELI_SISTEMA] ";
$qry .=    "".$txt_id_sistema."";
$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
if (! $rst) {  
   echo "Error en la ejecución de la instrucción ".$qry.".\n";
   die( print_r2( sqlsrv_errors(), true));  
   exit;
}else{
	while( $rowsu = sqlsrv_fetch_array($rst)){
		
		$valor_consulta = $rowsu[0]; // 0 error de conexion - 0 FALLO - 1 ELIMINO
	}
} 
sqlsrv_free_stmt( $rst );  
sqlsrv_close( $conn );

echo $valor_consulta;
?>
