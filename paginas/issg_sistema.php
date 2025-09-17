<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE');
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
session_valida();
$conn = conectate();

$txt_id_sistema = 0;
if(isset($_POST['txt_id_sistema'])){
	$txt_id_sistema = $_POST['txt_id_sistema'];}

$txt_sistema = "";
if(isset($_POST['txt_sistema'])){
	$txt_sistema = $_POST['txt_sistema'];}	
	

$cbo_status = "";
if(isset($_POST['cbo_status'])){
	$cbo_status = $_POST['cbo_status'];}


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


	<div id="div_alerta">
	</div>

	<div id="divProceso" class="cCargando" style="visibility: hidden;">
	</div>
	
	<div style="text-align: center;" id="div_carga">
		<img id="cargador" src="../imagenes/GIF/loading2.gif"/>
	</div>

	<div id="1"> <!--  inicio -->	
 
	 <div id="div_totulo" style="background:#EAEAEA; padding:15px;" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<!--<h3 class="h3 text-dark">Base de Datos </h3><span class="fa-twitter fa"></span> -->
		<h4 id="titulo_pantalla" class="text-light"><strong>Sistema</strong>s</h4>
		<span style="text-align:right" class="contorno fa fa-external-link fa-2x text-light"></span>
	 </div>	<!-- fin div_totulo -->	 	  

    	<section> 	
         <div id="id_container1" class="container border border-info" style="padding:15px;">

            <div id="2" class="form-row">
				<div id="3" class="col-2 input-group-sm">
					<label for="txt_id_sistema">Codigo</label>
					<input name="txt_id_sistema"   type="text" disabled = "disabled" class="form-control form-control-sm"  id="txt_id_sistema" aria-label="Small" >
				</div>
                
                <div id="4" class="col-7 input-group-sm">
                    <label for="txt_sistema"> Sistema </label>
                    <input  name="txt_sistema" type="text" class="form-control form-control-sm" id="txt_sistema" maxlength="50" aria-label="Small" onKeyUp="javascript:this.value=this.value.toUpperCase();">
                </div>
				
								
            </div><!-- id 2 -->         
		<div id="21" class="form-row">           
			<div id="5" style="padding-top:10px;"  class="col-2 input-group-sm">
			  <label for="cbo_status">Status</label>
			  <select id="cbo_status" class="form-control-sm custom-select" aria-label="Small" name="cbo_status">
				<option value="">--</option>
				<option value="0">Inactivo - 0 </option>
				<option value="1">Activo - 1</option>
			  </select>
			</div>	
		</div>
			
			
         </div><!-- fin id_container1 -->        


      
        <div id="id_container2" class="container border border-info" style="padding:15px;">
            <div id="div_row" class="form-row">
                <div id="boton1" style="vertical-align:middle" class="col-2">                   
                     <button  id="btn_nuevo" type="button" data-toggle="modal" data-target="#myModal" class="boton boton1 btn btn-outline-dark ">Nuevo</button>   
                </div>
                
                <div id="8" class="w-100"></div>
            
                <div id="boton2" class="col-2">
                    <button id="btn_guardar"  type="button"  data-toggle="modal" data-target="#myModal" class="boton boton2 btn btn-outline-dark ">Guardar</button>   
                </div>                    
                
                <div id="9" class="w-100"></div>
                
                <div id="boton3" class="col-2">
                   <button id="btn_eliminar"  type="button"  data-toggle="modal" data-target="#myModal" class="boton boton3 btn btn-outline-dark ">Eliminar</button>       
                </div>                    
                
                <div id="10" class="w-100"></div>
       
            </div>  
        </div><!-- fin id_container2 -->
       </section>
        
    <div id="id_container3" class="container-fluid border border-info" style="padding:15px;">

        <strong>Lista - Selecione</strong>
        <table class="table table-sm table-bordered  table-hover">
          
            <!-- <thead class="bg-info"> -->
			<thead style="background:#3399CC;">
            <tr>
              <th class="contorno_gris_th tiulo_th" scope="col">Codigo</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Sistema</th>              
              <th class="contorno_gris_th tiulo_th" scope="col">Status</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">usuario_crea</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">usuario_mod</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Fecha_crea</th>
            </tr>
          </thead>
          <tbody>
					<?PHP 
					$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_BUS_SISTEMA] 0";
					$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
					if (! $rst) {  
					   echo "Error en la ejecución de la instrucción ".$qry.".\n";
					   die( print_r2( sqlsrv_errors(), true));  
					   exit;
					}

				while( $rowsist = sqlsrv_fetch_array( $rst) ) 
				{
				?>
				   <tr onClick="javascript:bus_datos('<?PHP echo $rowsist['id_sistema'];?>',
				   								     '<?PHP echo $rowsist['sistema'];?>',
													 '<?PHP echo $rowsist['status'];?>',
													 '<?PHP echo $rowsist['usuario_crea'];?>',
													 '<?PHP echo $rowsist['usuario_mod'];?>',
													 '<?PHP echo $rowsist['fecha_crea'];?>'
													 )">
					  <th class="td_move" align="center" scope="row"><?PHP echo $rowsist['id_sistema'];?></th>
					  <td class="td_move"><?PHP echo utf8_encode($rowsist['sistema']);?></td>
					  <td class="td_move"><?PHP echo utf8_encode($rowsist['status']);?></td>
					  <td class="td_move"><?PHP echo $rowsist['usuario_crea'];?></td>
					  <td class="td_move"><?PHP echo $rowsist['usuario_mod'];?></td>
					  <td class="td_move"><?PHP echo $rowsist['fecha_crea'];?></td>					  
					</tr>
				<?PHP
				}
				sqlsrv_free_stmt( $rst );  
				sqlsrv_close( $conn );
				?>
          </tbody>
        </table>        
    </div><!-- fin id_container3 -->    
    
    
</div> <!-- fin inicio -->

<script>
			
function bus_datos(id,sistema,status)
{
	$("#txt_id_sistema").val(id);
	$("#txt_sistema").val(sistema);
	$("#cbo_status").val(status);
	
	if(id > 0)
		desbloquea_caja();
}


function initControls()
{
	window.location.hash="red";
	window.location.hash="Red"; //chrome
	window.onhashchange=function(){window.location.hash="red";}
}


function eliminar(valor)
{
	//ajax que ELIMINA
	$.ajax({
	type: "POST",
	dataType:"html",
	url: "../datos/eli_sistema.php",
	data:"txt_id_sistema="+valor,				 
    beforeSend: function(){    	    
    },	
	cache: false,			
	success: function(result) {	
		
		alert(result)
		if(result == 1){

			$('.modal-backdrop').hide();
			$("body").removeClass("modal-open");
			
			bloquea()
			toastr.success('Datos Eliminados con Éxito !!!', "Exito !!!", {
			"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});
			setTimeout(function(){ desbloquea();}, 5000);			

			$("#contenedor").empty();
			$('#contenedor').load('../paginas/issg_sistema.php');
			
		}else{
			toastr.error('Error Eliminando los datos en  la tabla < Sistemas > !!!', "Error !!!", {
			"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
			return false;			
		}
	},	
	error: function(error) {				
		alert("Problemas con la pagina alm_base_dato ... comuniquese con el Personal de Sistemas !!!" + error);
		}		
	});

}

$(document).ready(function(){  

bloquea_caja();

$('#div_carga')
			.hide()
			.ajaxStart(function() {
				$(this).show();
			})
			.ajaxStop(function() {
				$(this).hide();
			});
	
	initControls();	
	  $('#txt_sistema').focus();
		
	//------------------------->
	//PROCESO DE GUARDADO	
	$('#btn_nuevo').on('click', function(){	
		
		desbloquea_caja_nuevo();
		$("#txt_id_sistema").val(0);	
		$("#txt_sistema").val('');
		$("#cbo_status").val('');
		$("#txt_sistema").focus();
				
	});
	
	
	$('#btn_guardar').on('click', function(){	

		//inicio de validaciones		
		var txt_id_sistema		= 	$("#txt_id_sistema").val();
		var txt_sistema			= 	$.trim($("#txt_sistema").val()) 	;
		var cbo_status			= 	$.trim($("#cbo_status").val());

		if(txt_id_sistema == '')
		{
			 bloquea();
			 toastr.error("Error debe  -- <b> Selecionar un Codigo o tocar el Boton Nuevo <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});			
			setTimeout(function(){ desbloquea();}, 2000);				
			return false;	
		}
		
		if(txt_sistema == '' ||  txt_sistema.length < 4)
		{
			 bloquea();
			 toastr.error("Error en el Campo -- <b> NOMBRE DEL SISTEMA <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_sistema").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;	
		}
		
		if(cbo_status == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> STATUS <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#cbo_status").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;		
		}
		
				
			//ajax que guarda y modifica
			$.ajax({
			type: "POST",
			dataType:"html",
			url: "../datos/alm_sistema.php",
			data:"txt_id_sistema="+$("#txt_id_sistema").val()+
			 "&txt_sistema="+$("#txt_sistema").val()+
			 "&cbo_status="+$("#cbo_status").val(),
			cache: false,			
			success: function(result) {	
			alert(result);			
			
				if(result == 1){		
						
					bloquea()
					toastr.success('Datos Almacenados con Éxito !!!', "Exito !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_sistema.php');							
				
				}else if(result == 2){

					bloquea()
					toastr.success('Datos Actualizados con Éxito !!!', "Exito !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_sistema.php');							
				
				
				}else{
					toastr.error('Error Insertando los datos en  la tabla < Sistema > !!!', "Error !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"        		});	
					return false;			
				}		
			},			
			error: function(error) {				
				alert("Problemas con la pagina alm_sistema ... comuniquese con el Personal de Sistemas !!!" + error);
				}		
			});	
	});		
		
	$('#btn_eliminar').on('click', function(){
		var valor;
		valor = $('#txt_id_sistema').val();		
		if(valor == 0)	
		{
			bloquea();
			toastr.error('Error Debe Seleccionar un  < CODIGO > !!!', "Error !!!", {
				"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"
			});
			setTimeout(function(){ desbloquea();}, 2000);	
			return false;		
		}else{				
			$("#div_alerta").prepend(ventana_modal(valor,'ELIMINAR','Desea realmente eliminar este Registro ??? <'+ valor + '>','ELIMINAR',2));					

				$('#btn_modal_aceptar').on('click', function(){
					eliminar(valor);
				});	
			
		}	
	});		


    $(".td_move").click(function(evento){
       $("html,body").animate({scrollTop:0}, "slow");
    });

}); // fin ready


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

function bloquea_caja()
{
  	$("#txt_sistema").attr("disabled", true);
	$('#cbo_status').attr('disabled','0');		
}

function desbloquea_caja()
{
    $("#txt_sistema").attr("disabled", false);
	$('#cbo_status').attr('disabled',false);
}

function desbloquea_caja_nuevo()
{
    $("#txt_sistema").attr("disabled", false);
	$('#cbo_status').attr('disabled',false);	
}
</script>
</body>
</html>