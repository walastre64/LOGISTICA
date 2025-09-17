<?PHP
function conectate(){

		$serverName = "localhost"; //serverName\instanceName
		$connectionInfo = array( "Database"		=>"BahiaRRHH",
								 "UID"	   		=>"sa",
								 "PWD"	   		=>"",
								 "CharacterSet" =>"UTF-8",
								 "TrustServerCertificate" => "yes"
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
