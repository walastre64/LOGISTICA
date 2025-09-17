<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE');
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../restringir/restringir.ini.php");
include("../validacion/validacion_general2.php");
session_valida();
$conn = conectate();

$cbo_rol = "";
if(isset($_POST['cbo_rol'])){
	$cbo_rol = $_POST['cbo_rol'];}

$txt_id_rol = 0;
if(isset($_POST['txt_id_rol'])){
	$txt_id_rol = $_POST['txt_id_rol'];}

$txt_rol = 0;
if(isset($_POST['txt_rol'])){
	$txt_rol = $_POST['txt_rol'];}	
	
$txt_id_grupo = 0;
if(isset($_POST['txt_id_grupo'])){
	$txt_id_grupo = $_POST['txt_id_grupo'];}
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

<body onLoad="ini()" onkeypress="parar()" onclick="parar()">

<div id="div_alerta"></div>

	<div id="divProceso" class="cCargando" style="visibility: hidden;"></div>
		<div style="text-align: center;" id="div_carga">
			<img id="cargador" src="../imagenes/GIF/loading2.gif"/>
		</div>

<div id="1"> <!-- inicio -->
 
	 <div id="div_totulo" style="background:#EAEAEA; padding:15px;" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h4 id="titulo_pantalla" class="text-light"><strong>Rol</strong></h4>
		<span style="text-align:right" class="contorno fa fa-users fa-2x text-light"></span>
	 </div>	<!-- fin div_totulo -->	 	  

    	<section> 	
         <div id="id_container1" class="container border border-info" style="padding:15px;">

            <div id="2" class="form-row" style="margin-left:10px">
			
				<div id="3" class="col-1 input-group-sm">
				  <label for="txt_id_rol">Codigo</label>
				  <input name="txt_id_rol" type="text" disabled = "disabled" class="form-control form-control-sm"  id="txt_id_rol" aria-label="Small" >
				</div>				

				<div id="4" class="col-3 input-group-sm">
				  <label for="cbo_grupo">Grupo</label>
				  <select id="cbo_grupo"  disabled class="form-control form-control-sm" name="cbo_grupo">
				    <option value="0">-- Seleccione -- </option>
					<?PHP 
					$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_BUS_GRUPO] 0";
					$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
					if (! $rst) {  
					   echo "Error en la ejecución de la instrucción ".$qry.".\n";
					   die( print_r2( sqlsrv_errors(), true));  
					   exit;
					}
						while( $rowusu = sqlsrv_fetch_array($rst)) { ?>
						<option value="<?PHP echo $rowusu[0];?>"><?PHP echo $rowusu[1];?></option>
					<?PHP }?>
				  </select>
				  
				</div>				
			</div>           
			       
			<div style="margin-top:15px" id="5" class="col-7 input-group-sm">
				<label for="txt_nombre_bd">Nombre Rol </label>              
				<input name="txt_nombre_rol" type="text" class="form-control form-control-sm" id="txt_nombre_rol" onKeyUp="javascript:this.value=this.value.toUpperCase();" maxlength="50" aria-label="Small">              
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
              <th width="54" class="contorno_gris_th tiulo_th" scope="col">Codigo</th>
              <th width="83" class="contorno_gris_th tiulo_th" scope="col">Nombre rol</th>
              <th width="64" class="contorno_gris_th tiulo_th" scope="col">Grupo</th>
              <th width="64" class="contorno_gris_th tiulo_th" scope="col">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
				<?PHP 

				// BUSCA ROL
				$qry2 = "SP_BUS_ROL ".$txt_id_rol.",".$txt_id_grupo;
				$rst2 = sqlsrv_query( $conn, $qry2, array(), array("Scrollable"=>"buffered"));
				if (! $rst2) {  
				   echo "Error en la ejecución de la instrucción ".$qry2.".\n";
				   die( print_r2( sqlsrv_errors(), true));  
				   exit;
				}
				
				while( $rowusu = sqlsrv_fetch_array( $rst2) ) 
				{
				?>				
				   <tr>
					  <th class="td_move" onClick="javascript:bus_datos('<?PHP echo $rowusu['id_rol'];?>','<?PHP echo $rowusu['rol'];?>','<?PHP echo $rowusu['id_grupo'];?>')" align="center" scope="row"><?PHP echo $rowusu['id_rol'];?></th>
					  <td class="td_move" onClick="javascript:bus_datos('<?PHP echo $rowusu['id_rol'];?>','<?PHP echo $rowusu['rol'];?>','<?PHP echo $rowusu['id_grupo'];?>')"><?PHP echo $rowusu['rol'];?></td>
					  <td class="td_move" onClick="javascript:bus_datos('<?PHP echo $rowusu['id_rol'];?>','<?PHP echo $rowusu['rol'];?>','<?PHP echo $rowusu['id_grupo'];?>')"><?PHP echo $rowusu['nombre_grupo'];?></td>
				      <td class="td_move" onClick="javascript:bus_datos('<?PHP echo $rowusu['id_rol'];?>','<?PHP echo $rowusu['rol'];?>','<?PHP echo $rowusu['id_grupo'];?>')"><div align="center">asignar</div></td>
				   </tr>
				<?PHP
				}	  
				sqlsrv_free_stmt( $rst2 );  
				sqlsrv_close( $conn );
				


				?>
          </tbody>
        </table>        
    </div><!-- fin id_container3 -->    
    
    
</div> <!-- fin inicio -->

<script>
			
function bus_datos(id,nombre,id2)
{

	$("#txt_id_rol").val(id);
	$("#txt_nombre_rol").val(nombre);
	$("#cbo_grupo").val(id2);
	
	
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
	url: "../datos/eli_rol.php",
	data:"txt_id_rol="+valor,				 
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
			$('#contenedor').load('../paginas/issg_rol.php');

		}else if(result == 0){

			toastr.error('Este rol <'+ valor +'> Posee usuarios Asociados - No puede ser Eliminado!!!', "Error !!!", {
			"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});
			setTimeout(function(){ desbloquea();}, 6000);
			
			
		}else{
			toastr.error('Error Eliminando los datos en  la tabla < rol > !!!', "Error !!!", {
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
	$('#txt_nombre_rol').focus();
		
	//------------------------->
	//PROCESO DE GUARDADO	
	$('#btn_nuevo').on('click', function(){	
		
		desbloquea_caja();
		$("#txt_id_rol").val(0);	
		$("#txt_nombre_rol").val('');
		$("#cbo_grupo").val(0);
		
		$("#txt_nombre_rol").focus();
	});
	
	
	$('#btn_guardar').on('click', function(){	

		//inicio de validaciones		
		var txt_id_rol		= 	$("#txt_id_rol").val();
		var txt_nombre_rol	= 	$.trim($("#txt_nombre_rol").val());
		var	cbo_grupo		= 	$("#cbo_grupo").val();

		if(txt_id_rol == '')
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
		
		if(txt_nombre_rol == '' ||  txt_nombre_rol.length < 4)
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> NOMBRE rol <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_nombre_rol").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;	
		}
		
		if(cbo_grupo == '' || cbo_grupo == 0)
		{
			 bloquea();
			 toastr.error("Error debe  -- <b> Selecionar un Grupo <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});		
			$("#cbo_grupo").focus();	
			setTimeout(function(){ desbloquea();}, 2000);				
			return false;	
		}
		
				
			//ajax que guarda y modifica
			$.ajax({
			type: "POST",
			dataType:"html",
			url: "../datos/alm_rol.php",
			data:"txt_id_rol="+$("#txt_id_rol").val()+
			 	 "&txt_nombre_rol="+$("#txt_nombre_rol").val()+
				 "&cbo_grupo="+$("#cbo_grupo").val(),
			cache: false,			
			success: function(result) {
			
				if(result == 1){		
						
					bloquea()
					toastr.success('Datos Almacenados con Éxito !!!', "Exito !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_rol.php');							
				
				}else{
					toastr.error('Error Insertando los datos en  la tabla < rol > !!!', "Error !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"        		});	
					$("#txt_password").focus();
					return false;			
				}		
			},			
			error: function(error) {				
				alert("Problemas con la pagina alm_rol ... comuniquese con el Personal de Sistemas !!!" + error);
				}		
			});	
	});		
		
	$('#btn_eliminar').on('click', function(){
		var valor;
		valor = $('#txt_id_rol').val();		
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
	$("#txt_nombre_rol").attr("disabled", true);
	$("#cbo_grupo").attr("disabled", true);    

}

function desbloquea_caja()
{
	$("#txt_nombre_rol").attr("disabled", false);	
	$('#cbo_grupo').removeAttr('disabled');	
}
</script>
</body>
</html>