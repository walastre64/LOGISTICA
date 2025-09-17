<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE');
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
session_valida();
$conn = conectate();

$txt_id_grupo = 0;
if(isset($_POST['txt_id_grupo'])){
	$txt_id_grupo = $_POST['txt_id_grupo'];}

$txt_nombre_grupo = "";
if(isset($_POST['txt_nombre_grupo'])){
	$txt_nombre_grupo = $_POST['txt_nombre_grupo'];}	
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

* {
	margin: 0;
	padding: 0;
}
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
		<h4 id="titulo_pantalla" class="text-light"><strong>Grupos</strong></h4>
		<span style="text-align:right" class="contorno fa fa-users fa-2x text-light"></span>
	 </div>	<!-- fin div_totulo -->	 	  

    	<section> 	
         <div id="id_container1" class="container border border-info" style="padding:15px;">
            <div id="2">

				<div id="3" class="col-2 ">
				  <label for="txt_id_bd">Codigo</label>
				  <input name="txt_id_grupo" type="text" disabled = "disabled" class="form-control form-control-sm"  id="txt_id_grupo" aria-label="Small" >
				</div>
                
				<div style="margin-top:15px" id="4" class="col-7">
					<label for="txt_nombre_bd">Nombre Grupos </label>              
					<input name="txt_nombre_grupo" type="text" class="form-control form-control-sm" id="txt_nombre_grupo" onKeyUp="javascript:this.value=this.value.toUpperCase();" maxlength="50" aria-label="Small">              
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
              <th class="contorno_gris_th tiulo_th" scope="col">Nombre Grupo</th>
            </tr>
          </thead>
          <tbody>
				<?PHP 
				$qry = "SP_BUS_GRUPO ".$txt_id_grupo;
				$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
				if (! $rst) {  
				   echo "Error en la ejecución de la instrucción ".$qry.".\n";
				   die( print_r2( sqlsrv_errors(), true));  
				   exit;
				}
				
				while( $rowusu = sqlsrv_fetch_array( $rst) ) 
				{
				?>				
				   <tr>
					  <th class="td_move" onClick="javascript:bus_datos('<?PHP echo $rowusu['id_grupo'];?>','<?PHP echo $rowusu['nombre_grupo'];?>')" align="center" scope="row"><?PHP echo $rowusu['id_grupo'];?></th>
					  <td class="td_move" onClick="javascript:bus_datos('<?PHP echo $rowusu['id_grupo'];?>','<?PHP echo $rowusu['nombre_grupo'];?>')"><?PHP echo $rowusu['nombre_grupo'];?></td>
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
			
function bus_datos(id,nombre)
{
	$("#txt_id_grupo").val(id);
	$("#txt_nombre_grupo").val(nombre);
	if(id > 0)
		desbloquea_caja();
}


function initControls()
{
	window.location.hash="red";
	window.location.hash="Red"; //chrome
	window.onhashchange=function(){window.location.hash="red";}
}


function ventana_modal(valor,titulo,mensaje,cantidad_btn)
{		
var vmodal;		
vmodal = '';
	 <!-- ventana Modal -->
vmodal +='<div id="myModal" data-backdrop="static" data-keyboard="false" style="margin-top: 200px;" class="modal">';

  <!-- Modal content -->
vmodal +='  <div id="div_modal_content" class="modal-content">';
		
		<!-- Modal Header -->
vmodal +='		<div id="14" class="modal-header">';
vmodal +='			<h4 id="titulo" class="modal-title">'+ titulo+'</h4>';
vmodal +='				<button type="button" class="close" data-dismiss="modal">&times;</button>';
vmodal +='		</div>';
		<!-- FIN Modal Header -->	

		<!-- Modal body -->	
vmodal +='   	<div id="div_cuerpo_modal" class="modal-body">';
vmodal +='			<p id="mensaje">'+mensaje+'</p>';
vmodal +='		</div>';
		<!-- FIN Modal body -->	
   
   		<!-- Modal footer -->
vmodal +='	   <div id="15" class="modal-footer">';
vmodal +='   		<button id="btn_modal_aceptar" type="button" class="btn btn-info" data-dismiss="modal" data-backdrop="false" >Aceptar</button>';
vmodal +='	   </div>';
	   <!-- FIN Modal footer -->  
vmodal +='  </div>';
		
		return vmodal;		
}



function eliminar(valor)
{
	//ajax que ELIMINA
	$.ajax({
	type: "POST",
	dataType:"html",
	url: "../datos/eli_grupo.php",
	data:"txt_id_grupo="+valor,				 
    beforeSend: function(){    	    
    },	
	cache: false,			
	success: function(result) {	
		
		//alert(result)
		if(result == 1){

			$('.modal-backdrop').hide();
			$("body").removeClass("modal-open");
			
			bloquea()
			toastr.success('Datos Eliminados con Exito !!!', "Exito !!!", {
			"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});
			setTimeout(function(){ desbloquea();}, 5000);			
			$("#contenedor").empty();
			$('#contenedor').load('../paginas/issg_grupo.php');

		}else if(result == 0){

			toastr.error('Este Grupo <'+ valor +'> Posee usuarios Asociados - No puede ser Eliminado!!!', "Error !!!", {
			"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});
			setTimeout(function(){ desbloquea();}, 6000);
			
			
		}else{
			toastr.error('Error Eliminando los datos en  la tabla < Grupos > !!!', "Error !!!", {
			"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
			setTimeout(function(){ desbloquea();}, 5000);			
			$("#contenedor").empty();
			$('#contenedor').load('../paginas/issg_grupo.php');
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
	$('#txt_nombre_grupo').focus();
		
	//------------------------->
	//PROCESO DE GUARDADO	
	$('#btn_nuevo').on('click', function(){	
		
		desbloquea_caja();
		$("#txt_id_grupo").val(0);	
		$("#txt_nombre_grupo").val('');
		$("#txt_nombre_grupo").focus();
	});
	
	
	$('#btn_guardar').on('click', function(){	

		//inicio de validaciones		
		var txt_id_grupo		= 	$("#txt_id_grupo").val();
		var txt_nombre_grupo	= 	$.trim($("#txt_nombre_grupo").val());

		if(txt_id_grupo == '')
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
		
		if(txt_nombre_grupo == '' ||  txt_nombre_grupo.length < 4)
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> NOMBRE GRUPO <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_nombre_grupo").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;	
		}		
				
			//ajax que guarda y modifica
			$.ajax({
			type: "POST",
			dataType:"html",
			url: "../datos/alm_grupo.php",
			data:"txt_id_grupo="+$("#txt_id_grupo").val()+
			 	 "&txt_nombre_grupo="+$("#txt_nombre_grupo").val(),
			cache: false,			
			success: function(result) {
			
				if(result == 1){		
						
					bloquea()
					toastr.success('Datos Almacenados con Éxito !!!', "Exito !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_grupo.php');							
				
				}else{
					toastr.error('Error Insertando los datos en  la tabla < Grupos > !!!', "Error !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"        		});	
					$("#txt_password").focus();
					return false;			
				}		
			},			
			error: function(error) {				
				alert("Problemas con la pagina alm_grupo ... comuniquese con el Personal de Sistemas !!!" + error);
				}		
			});	
	});		
		
	$('#btn_eliminar').on('click', function(){
		var valor;
		valor = $('#txt_id_grupo').val();		
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
	$("#txt_nombre_grupo").attr("disabled", true);
}

function desbloquea_caja()
{
	$("#txt_nombre_grupo").attr("disabled", false);
}
</script>
</body>
</html>