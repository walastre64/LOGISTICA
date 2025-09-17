<?PHP
function conectate(){

		$serverName = "DCBAHIA\MSSQLSERVER2014"; //serverName\instanceName
		$connectionInfo = array( "Database"		=>"BahiaRRHH",
								 "UID"	   		=>"sa",
								 "PWD"	   		=>"Ec14312183.-",
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