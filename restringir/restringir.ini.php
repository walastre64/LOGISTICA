<?PHP
function session_valida()
{
	session_start();	
	if(!isset($_SESSION['cedula']))
	{
			header("location: ../index.php");
			session_destroy(); // destruyo la sesión 
			session_unset();	
	}else{
		$fechaGuardada = $_SESSION['ultimoacceso'];
		/*
		
		$ahora = date("Y-n-j H:i:s");
		$date1 = new DateTime("$fechaGuardada");
		$date2 = new DateTime("now");
		$diff = $date1->diff($date2);
		$minuto = ( ($diff->days * 24 ) * 60 ) + ( $diff->i );

		if($minuto > 1)
		{
			?> 
				<script languaje="javascript"> 
					alert("Fin de Session !!!"); 
					location.href = "../index.php"; 
				</script>
			<?php 
		}else{
			$_SESSION["ultimoAcceso"] = $ahora; 
		} 
	*/
	}
	
}
?>