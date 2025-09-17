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

$txt_usuario 	= $_POST['txt_usuario'];
$txt_clavea		= $_POST['txt_clavea'];
$txt_claven		= $_POST['txt_claven'];
$txt_clavec		= $_POST['txt_clavec'];

$valor_consulta = 0;

// busco para validar que la clave actual coincida con la de la bd
//**********************************************************************
$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC SP_BUS_USUARIO_WEB ".$txt_usuario.",''";
$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
if (! $rst) {  
   echo "Error en la ejecuci?n de la instrucci?n ".$qry.".\n";
   die( print_r2( sqlsrv_errors(), true));  
   exit;
}else{
	$rowCount = sqlsrv_num_rows( $rst );	

	if($rowCount > 0)
	{		
		while( $rowusu = sqlsrv_fetch_array($rst)) 		
		{		
				if ($rowusu[2] == md5($txt_clavea) )
				{
					// clave coincide
					// ejecuto la actualizacion de la clave y debo sacarlos del sistema para volver a crear las variables de session
					$qry1 = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC SP_ACT_USUARIO ".$txt_usuario.",'".md5($txt_clavec)."'";
					$rst1 = sqlsrv_query( $conn, $qry1, array(), array("Scrollable"=>"buffered"));
					if (! $rst1) {  
					   echo "Error en la ejecuci?n de la instrucci?n ".$qry1.".\n";
					   die( print_r2( sqlsrv_errors(), true));  
					   $valor_consulta  = "0"."/";
					   exit;					   
					}else{
						while( $row = sqlsrv_fetch_array( $rst1, SQLSRV_FETCH_NUMERIC) ) 
						{
							$valor_consulta = $row[0]; // valor 1 indica qe se ejecuto el SP
						}
					}					

				}else{
					// clave errada
					$valor_consulta  = "2"."/";
					$valor_consulta .= $txt_usuario;
				}			
		} // fin while
	
	}else{
		
			// usuario no existente
			$valor_consulta  = "3"."/";
			$valor_consulta .= $txt_usuario;

	} //fin if rowCount	
	
} // fin if rs

sqlsrv_free_stmt( $rst );
sqlsrv_close( $conn );  

echo $valor_consulta;

?>
