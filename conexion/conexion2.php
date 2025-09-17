<?PHP
function conectate()
{	
	$Bd    = "10.50.10.25\MSSQLSERVER2012";
	$Usu   = "sa";
	$Clave = "";

	$link=mssql_connect($Bd,$Usu,$Clave ); //or die("0|Error conectando a la base de datos.");
	mssql_select_db("Helpdesk",$link); //or die("0|Error seleccionando la base de datos.");
}
?>
