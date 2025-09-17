<!DOCTYPE html>
<html lang="en">
<head>
	<title>Logística - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Pragma"  content="no-cache" />
    
    
    <link rel="stylesheet" href="config_boostrap/bootstrap.min.css">
    <script src="config_jquery/jquery.min.js"></script>
    <script src="config_popper/popper.min.js"></script>
    <script src="config_boostrap/bootstrap.min.js"></script>    
	
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-ico"/>
    

	<link rel="stylesheet" href="bootstrap/dist/awesome/css/font-awesome.min.css" 	crossorigin="anonymous">
	<link rel="stylesheet" href="bootstrap/dist/toastr/toastr.min.css"  			crossorigin="anonymous">

    
<script type="text/javascript">

$(document).ready(function() {

	$(":input:first").focus();

	
	$("#username").keypress(function(event) {
		if (event.which == 13) {
			$("#btn_login").click();
		 }
	});	
	
	$("#password").keypress(function(event) {
		if (event.which == 13) {
			$("#btn_login").click();
		 }
	})
	
	$("#btn_login").click(function(){
		
		var User = $.trim($("#username").val());
		var Pass = $.trim($("#password").val());
		
		if(User.length < 1 || User.length < 3)
		{
			 toastr.error("Error en en Campo -- <b> USUARIO <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-top-full-width"
        	});	
			$("#username").focus();			
			return false;
		}
		
		if(Pass.length <1 )
		{
			 toastr.error("Error en en Campo -- <b> PASSWORD <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  //"positionClass": "toast-bottom-full-width"
			  "positionClass": "toast-top-full-width"
        	});	
			$("#password").focus();
			document.getElementById('password').value = '';
			return false;		
		}
		
		var tamano; 
		tamano = (Pass.length);
		
		if(tamano < 4)
		{
			 toastr.error("El en en Campo -- <b> PASSWORD <b/> -- debe tener mas de 4 Caracteres", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-top-full-width"
        	});	
			$("#password").focus();
			document.getElementById('password').value = '';
			//setTimeout(function(){ $('#div_carga').hide();}, 2000);
			return false;	
		}

		$.ajax({
		type: "POST",
		dataType:"html",
		url: "datos/bus_usuario_registrado.php",
		data:"username="+$("#username").val()+
			 "&password="+$("#password").val(),
		cache: false,			
		success: function(result) {	
		resultado=result.split("/");
		//alert(result);
	if(resultado[0] == 1){		
		
		location.href='menu/principal.php';
		return result;
	
	}else{
		toastr.error('Usuario ó Clave incorreta !!!', "Error !!!", {
		"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-top-full-width"        		});	
		$("#password").focus();					
		return false;			
	}		
		},			
		error: function(error) {				
			alert("Problemas con el Ingreso al Sistema ... comuniquese con el Personal de Sistemas !!!" + error);			
			}		
		});	
		
		 
	});	<!-- fin btn_login -->
	
	
});
</script>
</head>
<body>
	<div class="container">
     <div class="logo" id="logo">
     	<img class="img-fluid" src="imagenes/logos/logo_empresa_2.svg" alt="Logo">
	 </div>		
        <h2 class="titulo1">Logística</h2>
        
		<form>
			<div class="form-group">
				
	                <label for="username">Usuario:</label>
					<input type="text" class="form-control" id="username" placeholder="usuario">
                
				
	                <label for="password">Password:</label>
					<input type="password" class="form-control" id="password" placeholder="password">
               
			</div>
			
            
            <button style="margin-top:20px" id="btn_login" type="button" name="btn_login" tabindex="2" class="btn btn-primary">Ingresar</button>
            
            	<!--<p class="message">Olvido su usuario/clave? <a href="#">Recordar</a></p> -->
            
		</form>
	</div>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script type='text/javascript' src="validacion/validacion_general.js"></script>   	
   <script type='text/javascript' src="bootstrap/dist/toastr/toastr.min.js"></script>   
   <script src="jquery/popper.min.js" crossorigin="anonymous"></script>
   <script src="bootstrap/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->	    
</body>
</html>