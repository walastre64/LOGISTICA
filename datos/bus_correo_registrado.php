<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE'); # Localiza en espa�ol es_Venezuela
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
// ------------------------------------------------->
session_valida();
$conn = conectate();

$txt_email_olvidado	= ($_POST['txt_email_olvidado']);
$valor_consulta = 0;

// verifico que el usuario exista con esa cedula
$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC SP_BUS_USUARIO_WEB 0,'".$txt_email_olvidado."'";
$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
if (! $rst) {
   echo "Error en la ejecución de la instrucción ".$qry.".\n";
   die( print_r2( sqlsrv_errors(), true));  
   exit;
}else{
	$rowCount = sqlsrv_num_rows( $rst );	

	if($rowCount > 0)
	{		
		while( $rowusu = sqlsrv_fetch_array($rst)) 		
		{		
			$valor_consulta  = "1"."/";
			$valor_consulta .= $rowusu[1]."/"; // cedula 
			$valor_consulta .= $rowusu[3]."/"; // nombre 
			$valor_consulta .= $rowusu[4]; 	   // apellido
			
		} // fin while
	
	}else{
		
			// usuario no existente
			$valor_consulta  = "2"."/";
			$valor_consulta .= $txt_email_olvidado;

	} //fin if rowCount	
	
} // fin if rs

sqlsrv_free_stmt( $rst );  
sqlsrv_close( $conn );

echo $valor_consulta;
?>