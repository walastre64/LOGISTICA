<?PHP
function conectate()
{	
	//$Bd    = "10.50.23.12\MSSQLSERVER2012";
	$Bd    = "WALASTRE_LAPTO\MSSQLSERVER2014";
	$nbb   = "CABALLOS";
	$Usu   = "sa";
	$Clave = "1230";

	//$Bd    = "BPWIN8\MSSQLSERVER2012";
	//$nbb   = "CABALLOS";
	//$Usu   = "sa";
	//$Clave = "1230";


	$link=mssql_connect($Bd,$Usu,$Clave ); //or die("0|Error conectando a la base de datos.");
	mssql_select_db($nbb,$link); //or die("0|Error seleccionando la base de datos.");
}
?>