<?PHP
function conectate($puerto)
{	

	if($puerto == 1){
		$Bd    = "10.10.10.101,2433";
		$nbb   = "operaciones_ptoc";
	}
	elseif($puerto == 2){
		$Bd    = "10.20.10.99,2433";
		$nbb   = "operaciones_b";	
	}
	elseif($puerto == 3){
		$Bd    = "10.30.0.11,2433";	
		$nbb   = "operaciones_mbo";
	}
	elseif($puerto == 4){
		$Bd    = "10.40.10.7,2433";	
		$nbb   = "operaciones_g";
	}
	elseif($puerto == 5){
		$Bd    = "10.50.10.25\MSSQLSERVER2012";
		$nbb   = "bolipuertos_ccs";
	}
	elseif($puerto == 6){
		$Bd    = "10.60.10.249";
		$nbb   = "operaciones_gua";
	}
	$Usu   = "recibo";
	$Clave = "pu3rt02008";

	$link=mssql_connect($Bd,$Usu,$Clave ); //or die("0|Error conectando a la base de datos.");
	mssql_select_db($nbb,$link); //or die("0|Error seleccionando la base de datos.");
}
?>