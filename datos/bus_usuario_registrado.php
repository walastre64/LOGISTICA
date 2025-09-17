<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE'); # Localiza en espa�ol es_Venezuela
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
//include('../restringir/restringir.ini.php');
// ------------------------------------------------->
//session_valida();
$conn = conectate();
session_start();


$username	= sanear_string($_POST['username']);	
$password	= ($_POST['password']);

$valor_consulta = 0;

// verifico que el usuario exista con esa cedula
$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_BUS_USUARIO_LOG] '".$username."','".$password."'";
//echo $qry;
$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
if (! $rst) {  
   echo "Error en la ejecuci�n de la instrucci�n ".$qry.".\n";
   die( print_r2( sqlsrv_errors(), true));  
   exit;
}else{
	$rowCount = sqlsrv_num_rows( $rst );	

	if($rowCount > 0)
	{		
		while( $rowusu = sqlsrv_fetch_array($rst)) 		
		{		
	
			$valor_consulta  = "1"."/";
			$valor_consulta .= $rowusu[0]."/"; // id_usuario 
			$valor_consulta .= $rowusu[1]."/"; // usuario 
			$valor_consulta .= $rowusu[2]; 	   // status

			$_SESSION['id_usuario']		= $rowusu['id_usuario'];
			$_SESSION['ip']				= $_SERVER['REMOTE_ADDR'];
			$_SESSION['pc']				= gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$_SESSION['ultimoacceso'] 	= date("Y-n-j H:i:s");
			$_SESSION['nombre']			= $rowusu[1];
			$_SESSION['rol']			= $rowusu['status'];
			$_SESSION['nrol']			= $rowusu[2];
			$_SESSION['ngrupo']			= $rowusu[2];
			
		} // fin while
	
	}else{
		
			// usuario no existente
			$valor_consulta  = "3"."/";
			$valor_consulta .= $username;

	} //fin if rowCount	
	
} // fin if rs

sqlsrv_free_stmt( $rst );  
sqlsrv_close( $conn );  

echo $valor_consulta;
?>