<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE');
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
session_valida();
$conn = conectate();

$txt_id_sucu = 0;
if(isset($_POST['txt_id_sucu'])){
	$txt_id_sucu = $_POST['txt_id_sucu'];}

$txt_nombre_sucu = "";
if(isset($_POST['txt_nombre_sucu'])){
	$txt_nombre_sucu = $_POST['txt_nombre_sucu'];}	
	
$txt_direccion_sucu = "";
if(isset($_POST['txt_direccion_sucu'])){
	$txt_direccion_sucu = $_POST['txt_direccion_sucu'];}	

$txt_status = "";
if(isset($_POST['txt_status'])){
	$txt_status = $_POST['txt_status'];}

$txt_codigo_interno = "";
if(isset($_POST['txt_codigo_interno'])){
	$txt_codigo_interno = $_POST['txt_codigo_interno'];}
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
		<div style="text-align: center;" id="div_carga">
			<img id="cargador" src="../imagenes/GIF/loading2.gif"/>
		</div>

<div id="1"> <!-- inicio -->		
 
	 <div id="div_totulo" style="background:#EAEAEA; padding:15px;" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<!--<h3 class="h3 text-dark">Base de Datos </h3><span class="fa-twitter fa"></span> -->
		<h4 id="titulo_pantalla" class="text-light"><strong>Sucursales</strong></h4>
		<span style="text-align:right" class="contorno fa fa-home fa-2x text-light"></span>
	 </div>	<!-- fin div_totulo -->	 	  

    	<section> 	
         <div id="id_container1" class="container border border-info" style="padding:15px;">
            <div id="2" class="form-row">
              <div id="3" class="col-2 input-group-sm">
                  <label for="txt_id_sucu">Codigo</label>
                  <input name="txt_id_sucu"   type="text" disabled = "disabled" class="form-control form-control-sm"  id="txt_id_sucu" aria-label="Small" >
              </div>
                
                <div id="4" class="col-7 input-group-sm">
                    <label for="txt_nombre_sucu">Sucursal</label>              
                    <input name="txt_nombre_sucu" type="text" class="form-control form-control-sm" id="txt_nombre_sucu" maxlength="50" aria-label="Small">              
                </div>
				
				<div id="6"  class="col-2 input-group-sm">
                    <label for="txt_codigo_interno">Codigo Interno </label>              
                   <input name="txt_codigo_interno" type="text" class="form-control form-control-sm" id="txt_codigo_interno" size="3" maxlength="2" aria-label="Small" onKeyPress="return solonumeros(event)">
                </div>
				
                <div id="5" style="padding-top:10px;" class="col-9 input-group-sm">
                    <label for="txt_direccion_sucu">Dirección </label>              
                    <input name="txt_direccion_sucu" type="text" class="form-control form-control-sm" id="txt_direccion_sucu" maxlength="50" aria-label="Small">              
                </div>
				
                <div id="7" style="padding-top:10px;" class="col-2 input-group-sm">
                  <label for="txt_status">Status</label>
                  <select id="txt_status" class="form-control-sm custom-select" aria-label="Small" name="txt_status">
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
          
            <thead style="background:#3399CC;">
            <tr>
              <th class="contorno_gris_th tiulo_th" scope="col">Codigo</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Sucursal</th>              
			  <th class="contorno_gris_th tiulo_th" scope="col">Dirección</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Codigo Interno</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Status</th>			  
            </tr>
          </thead>
          <tbody>
				<?PHP 
				$qry = "SP_BUS_SUCURSAL ".$txt_id_sucu.",'".$txt_nombre_sucu."'";
				$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
				if (! $rst) {  
				   echo "Error en la ejecución de la instrucción ".$qry.".\n";
				   die( print_r2( sqlsrv_errors(), true));  
				   exit;
				}
				
				while( $rowusu = sqlsrv_fetch_array( $rst) ) 
				{
				?>				
				   <tr onClick="javascript:bus_datos('<?PHP echo $rowusu['id_sucu'];?>','<?PHP echo utf8_encode($rowusu['nombre_sucu']);?>','<?PHP echo utf8_encode($rowusu['direccion_sucu']);?>','<?PHP echo $rowusu['codigo_interno'];?>','<?PHP echo $rowusu['status'];?>')">
					  <th class="td_move" align="center" scope="row"><?PHP echo $rowusu['id_sucu'];?></th>
					  <td class="td_move"><?PHP echo utf8_encode($rowusu['nombre_sucu']);?></td>
					  <td class="td_move"><?PHP echo utf8_encode($rowusu['direccion_sucu']);?></td>
					  <td class="td_move"><?PHP echo $rowusu['codigo_interno'];?></td>
					  <td class="td_move"><?PHP echo $rowusu['status'];?></td>


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
			
function bus_datos(id,nombre,direccion,codigo_interno,status)
{
	$("#txt_id_sucu").val(id);
	$("#txt_nombre_sucu").val(nombre);
	$("#txt_direccion_sucu").val(direccion);
	$("#txt_status").val(status);
	$("#txt_codigo_interno").val(codigo_interno);	
	
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
	url: "../datos/eli_sucursal.php",
	data:"txt_id_sucu="+valor,				 
    beforeSend: function(){    	    
    },	
	cache: false,			
	success: function(result) {	
		
		//alert(result)
		if(result == 1){

			$('.modal-backdrop').hide();
			$("body").removeClass("modal-open");
			
			bloquea()
			toastr.success('Datos Eliminados con Éxito !!!', "Exito !!!", {
			"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});
			setTimeout(function(){ desbloquea();}, 5000);			

			$("#contenedor").empty();
			$('#contenedor').load('../paginas/issg_sucursal.php');	  			

			
		}else{
			toastr.error('Error Eliminando los datos en  la tabla < Sucursal > !!!', "Error !!!", {
			"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
			return false;			
		}
	},	
	error: function(error) {				
		alert("Problemas con la pagina alm_sucursal ... comuniquese con el Personal de Sistemas !!!" + error);
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
		$('#txt_nombre_sucu').focus();
	   //$("#txt_direccion_sucu").focus();
		
	//------------------------->
	//PROCESO DE GUARDADO	
	$('#btn_nuevo').on('click', function(){	
		
		desbloquea_caja_nuevo();
		$("#txt_id_sucu").val(0);	
		$("#txt_nombre_sucu").val('');
		$("#txt_direccion_sucu").val('');
		$("#txt_status").val('');
		$("#txt_codigo_interno").val('');	
		$("#txt_nombre_sucu").focus();		
	});
	
	
	$('#btn_guardar').on('click', function(){	

		//inicio de validaciones		
		var txt_id_sucu			= 	$("#txt_id_sucu").val();
		var txt_nombre_sucu		= 	$.trim($("#txt_nombre_sucu").val()) 	;
		var txt_direccion_sucu	= 	$.trim($("#txt_direccion_sucu").val());
		var txt_status			= 	$.trim($("#txt_status").val());
		var txt_codigo_interno	= 	$.trim($("#txt_codigo_interno").val());

		if(txt_id_sucu == '')
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
		
		if(txt_nombre_sucu == '' ||  txt_nombre_sucu.length < 4)
		{
			 bloquea();
			 toastr.error("Error en el Campo -- <b> SUCURSAL <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_nombre_sucu").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;	
		}
		
		if(txt_codigo_interno == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b>  Codigo Interno <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_codigo_interno").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}

		if(txt_status == '')
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
			$("#txt_status").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;		
		}
				
			//ajax que guarda y modifica
			$.ajax({
			type: "POST",
			dataType:"html",
			url: "../datos/alm_sucursal.php",
			data:"txt_id_sucu="+$("#txt_id_sucu").val()+
			 "&txt_nombre_sucu="+$("#txt_nombre_sucu").val()+
			 "&txt_direccion_sucu="+$("#txt_direccion_sucu").val()+
			 "&txt_status="+$("#txt_status").val()+
			 "&txt_codigo_interno="+$("#txt_codigo_interno").val(),
			cache: false,			
			success: function(result) {	
			//alert(result);			
				if(result == 1){		
						
					bloquea()
					toastr.success('Datos Almacenados con Éxito !!!', "Exito !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_sucursal.php');							
				
				}else if(result == 2){

					bloquea()
					toastr.success('Datos Actualizados con Éxito !!!', "Exito !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_sucursal.php');							

				}else if(result == 3){

					toastr.error('Error !!! Codigo Interno ya esta en uso ... Verifique !!!', "Error !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});
					return false;			

				}else{
					toastr.error('Error Insertando los datos en  la tabla < Sucursal > !!!', "Error !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});
					return false;			
				}		
			},			
			error: function(error) {				
				alert("Problemas con la pagina alm_sucursal ... comuniquese con el Personal de Sistemas !!!" + error);
				}		
			});	
	});		
		
	$('#btn_eliminar').on('click', function(){
		var valor;
		valor = $('#txt_id_sucu').val();		
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
  	$("#txt_nombre_sucu").attr("disabled", true);
	$("#txt_direccion_sucu").attr("disabled", true);
	$('#txt_status').attr('disabled','0');	
	$('#txt_codigo_interno').attr('disabled','0');	
	$("#txt_codigo_serie").attr('disabled','0');
}

function desbloquea_caja()
{
  //$("#txt_nombre_sucu").attr("disabled", false);
    $("#txt_nombre_sucu").attr("disabled", true);
	$("#txt_direccion_sucu").attr("disabled", false);
	$('#txt_status').attr('disabled',false);	
	$('#txt_codigo_interno').attr('disabled',false);
}

function desbloquea_caja_nuevo()
{
    $("#txt_nombre_sucu").attr("disabled", false);
	$("#txt_direccion_sucu").attr("disabled", false);
	$('#txt_status').attr('disabled',false);	
	$('#txt_codigo_interno').attr('disabled',false);	
}
</script>
</body>
</html>