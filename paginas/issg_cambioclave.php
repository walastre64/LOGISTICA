<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE');
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
session_valida();
$conn = conectate();

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
	<meta http-equiv="Content-type" content="text/html"; charset="UTF-8"/>
	<meta http-equiv="content-type" content="text/html"; charset="ISO-8859-1"/>
	<meta http-equiv="Content-Type" content="text/html;" charset="utf-8"/>
    
	
    <!-- Required meta tags -->
    <meta charset="utf-8">	
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no, user-scalable=no">
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Pragma"  content="no-cache" />
    <!-- Bootstrap core CSS -->

<script src="../jquery/jquery-3.3.1.min.js"></script>
<script src="../validacion/validacion_general.js"></script>
<link rel="stylesheet" type="text/css" href="../css/general.css">

<style type="text/css">
<!--

-->
</style>
</head>

<body>

<div id="div_alerta"></div>

	<div id="divProceso" class="cCargando" style="visibility: hidden;"></div>
		<div id="div_carga">
			<img id="cargador" src="../imagenes/GIF/loading2.gif"/>
		</div>

<div id="1"> <!--  inicio -->	
 
	    <div id="div_totulo" style="background:#EAEAEA; padding:15px;" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		    <h4 id="titulo_pantalla" class="text-light"><strong>Cambio de Clave</strong></h4>
		    <span style="text-align:right" class="contorno fa fa-unlock-alt fa-2x text-light"></span>
	    </div>	<!-- fin div_totulo -->	 	     	
    
</div> <!-- fin inicio -->

        <section> 	
            <div id="id_container1" class="container border border-info" style="">
                
                <div id="2" class="form-row">
                    <div id="3" class="col-2 input-group-sm">
                        <label for="txt_usuario">Usuario</label>
                        <input name="txt_usuario" type="text" value="<?PHP echo $_SESSION['cedula']?>" disabled = "disabled" class="form-control form-control-sm"  id="txt_usuario" aria-label="Small" >
                    </div>
                    <div id="4" class="col-4 input-group-sm">
                        <label for="txt_clavea">Clave Anterior</label>
                        <input name="txt_clavea" type="password" class="form-control form-control-sm"  id="txt_clavea" aria-label="Small" >
                    </div>
                </div> 
                <div id="5" class="form-row">
                    <div id="6" class="col-2 input-group-sm">
                    </div>
                    <div id="7" class="col-4 input-group-sm">
                        <label for="txt_claven">Clave Nueva</label>
                        <input name="txt_claven" type="password" class="form-control form-control-sm"  id="txt_claven" aria-label="Small" >
                    </div>
                </div> 

                <div id="8" class="form-row">
                    <div id="9" class="col-2 input-group-sm">
                    </div>
                    <div id="10" class="col-4 input-group-sm" style="padding-bottom:5px">
                        <label for="txt_clavec">Confirmar Clave</label>
                        <input name="txt_clavec" type="password" class="form-control form-control-sm"  id="txt_clavec" aria-label="Small" >
                    </div>
                </div> 
            </div><!-- fin id_container1 -->        
        
            <div id="id_container2" class="container border border-info" style="">
                <div id="div_row" class="form-row">
                    
                    <div id="8" class="w-100"></div>
                
                    <div id="boton2" class="col-2">
                        <button id="btn_guardar"  type="button"  data-toggle="modal" data-target="#myModal" class="boton boton2 btn btn-outline-dark ">Guardar</button>   
                    </div>                    
                    
                    <div id="9" class="w-100"></div>                    
                    
                    <div id="10" class="w-100"></div>                
                </div>  
            </div><!-- fin id_container2 -->
            
        </section>


<script>

function bloquea()
{
	document.getElementById("divProceso").style.visibility = "visible";
	$('#div_carga').show();		
}

function desbloquea()
{
	document.getElementById("divProceso").style.visibility = "hidden";
	$('#div_carga').hide();		
}

function initControls()
{
	window.location.hash="red";
	window.location.hash="Red"; //chrome
	window.onhashchange=function(){window.location.hash="red";}
}

$(document).ready(function(){  

$("#txt_clavea").focus();

$('#div_carga')
			.hide()
			.ajaxStart(function() {
				$(this).show();
			})
			.ajaxStop(function() {
				$(this).hide();
			});
	
	initControls();	
   

    $('#btn_guardar').on('click', function(){
    
        //validacion de campos
        var txt_usuario	= 	$.trim($("#txt_usuario").val());
        var txt_clavea	= 	$.trim($("#txt_clavea").val());
        var txt_claven	= 	$.trim($("#txt_claven").val());
        var txt_clavec	= 	$.trim($("#txt_clavec").val());
      
        if(txt_clavea == '')
		{
			 bloquea();
			 toastr.error("Error debe  -- <b> Debe colocar la Clave actual <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});			
			setTimeout(function(){ desbloquea(), $('#txt_clavea').focus();}, 2000);
			return false;	
		}
		
        if(txt_claven == '')
		{
			 bloquea();
			 toastr.error("Error debe  -- <b> Debe colocar la Clave Nueva <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});			
			setTimeout(function(){ desbloquea(), $('#txt_claven').focus();}, 2000);
			return false;	
		}		

        if(txt_clavec == '')
		{
			 bloquea();
			 toastr.error("Error debe  -- <b> Debe colocar la Confirmación <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});			
			setTimeout(function(){ desbloquea(), $('#txt_clavec').focus();}, 2000);
			return false;	
		}
		
		// comparacion de clave nueva con actual //
		if(txt_claven != txt_clavec){
		
			 bloquea();
			 toastr.error("Error debe  -- <b> La Clave nueva no coincide con la Confirmación <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});			
			setTimeout(function(){ desbloquea(), $('#txt_claven').focus();}, 2000);
			return false;			
		
		}
		if(txt_clavec != txt_claven){
		
			 bloquea();
			 toastr.error("Error debe  -- <b> La Confirmación no coincide con la Clave Nueva <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});			
			setTimeout(function(){ desbloquea(), $('#txt_clavec').focus();}, 2000);
			return false;			
		
		}


		var regex2 =/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}[^'\s]/;
		//alert(regex2.test($('#txt_email').val());
		var pas1 = $('#txt_claven').val();
		var pas2 = $('#txt_clavec').val();
		if (regex2.test(pas1.trim()) == false){
			 toastr.error("Error en en Campo -- <b> Passwor <b/> -- <br>- Minimo 6 caracteres <br>- Maximo 8 caracteres <br>- Al menos una letra mayúscula <br>- Al menos una letra minucula <br>- Al menos un dígito Numerico <br>- No espacios en blanco <br>- Al menos 1 caracter especial", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_claven").focus();
			$('#div_carga').hide();	
			return false				
		}
		if(pas1 != pas2){
			   toastr.error("Error en en Campo -- <b>La Confirmación no coincide con el Password <b/>", 
			   "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_passwordR").focus();
			setTimeout(function(){ $('#div_carga').hide();}, 2000);
			return false	
		}

		//ajax que guarda  clave nueva revisando que la anterior este correcta y
		$.ajax({
		type: "POST",
		dataType:"html",
		url: "../datos/alm_cambio_clave.php",
		data:"txt_usuario="+$("#txt_usuario").val()+
		 "&txt_clavea="+$("#txt_clavea").val()+
		 "&txt_claven="+$("#txt_claven").val()+
		 "&txt_clavec="+$("#txt_clavec").val(),				 
		cache: false,			
		success: function(result) {	
		resultado=result.split("/");
		alert(resultado[0]);
		
			if(resultado[0] == 1){
				bloquea()
				toastr.success('Datos Almacenados con Éxito !!!', "Exito !!!", {
				"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
				setTimeout(function(){ desbloquea();}, 5000);

				$("#contenedor").empty();
				$('#contenedor').load('../paginas/issg_cambioclave.php');							
			
			}else{
				toastr.error('Error Actualizando los datos en  la tabla < Usuarios > !!!', "Error !!!", {
				"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"        		});	
				$("#txt_password").focus();
				return false;			
			}		
		},			
		error: function(error) {				
			alert("Problemas con la pagina alm_base_dato ... comuniquese con el Personal de Sistemas !!!" + error);
			}		
		});	
    
    });/* fin $('#btn_guardar') */

    $(".td_move").click(function(evento){
       $("html,body").animate({scrollTop:0}, "slow");
    });

});/* fin ready */
    
		


</script>
</body>
</html>