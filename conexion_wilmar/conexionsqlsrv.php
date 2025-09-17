<?PHP
function conectate(){

		$serverName = "A000462820"; //serverName\instanceName
		$connectionInfo = array( "Database"		=>"AESIGESP",
								 "UID"	   		=>"sa",
								 "PWD"	   		=>"T3mP0ral77",
								 "CharacterSet" =>"UTF-8"
								 );
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
	
		if( $conn  == false) {
			 echo "Conexión no se pudo establecer.<br />";
			 die( print_r( sqlsrv_errors(), true));
		}else{
			return $conn;
		}
}
?>