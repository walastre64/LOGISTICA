<?PHP
function conectate(){

		//$serverName = "WIN-TLLNFLS722B"; //serverName\instanceName
		$serverName = "WALASTRE-LAPTO\MSSQLSERVER2014"; //serverName\instanceName
		$connectionInfo = array( "Database"=>"AESIGESP_DESARROLLO", 
								 "UID"	   =>"sa", 
								 "PWD"	   =>"sql2008sa",
								 "CharacterSet" => "UTF-8"

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