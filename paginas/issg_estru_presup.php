<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE');
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
session_valida();
$conn = conectate();

$txt_id_estru_presu = 0;
if(isset($_POST['txt_id_estru_presu'])){
	$txt_id_estru_presu = $_POST['txt_id_estru_presu'];}

$cbo_id_programa_detalle = 0;
if(isset($_POST['cbo_id_programa_detalle'])){
	$cbo_id_programa_detalle = $_POST['cbo_id_programa_detalle'];}	

$txt_codestpro1 = 0;
if(isset($_POST['txt_codestpro1'])){
	$txt_codestpro1 = $_POST['txt_codestpro1'];}

$txt_codestpro2 = 0;
if(isset($_POST['txt_codestpro2'])){
	$txt_codestpro2 = $_POST['txt_codestpro2'];}	

$txt_codestpro3 = 0;
if(isset($_POST['txt_codestpro3'])){
	$txt_codestpro3 = $_POST['txt_codestpro3'];}	

$txt_codestpro4 = 0;
if(isset($_POST['txt_codestpro4'])){
	$txt_codestpro4 = $_POST['txt_codestpro4'];}	

$txt_codestpro5 = 0;
if(isset($_POST['txt_codestpro5'])){
	$txt_codestpro5 = $_POST['txt_codestpro5'];}	
	
$cbo_estcla = 0;
if(isset($_POST['cbo_estcla'])){
	$cbo_estcla = $_POST['cbo_estcla'];}	
	
$cbo_periodo = '';
if(isset($_POST['cbo_periodo'])){
	$cbo_periodo = $_POST['cbo_periodo'];}
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
a {
	text-decoration: none;
}

#enlace{
	text-decoration:none;
}
-->
</style>
</head>

<body>
<div id="1"> <!-- inicio -->		

<div id="div_alerta"></div>

	<div id="divProceso" class="cCargando" style="visibility: hidden;"></div>
		<div style="text-align: center;" id="div_carga">
			<img id="cargador" src="../imagenes/GIF/loading2.gif"/>
		</div>
	<div>	
	<a name="ir"></a> 
	 <div id="div_totulo" style="background:#EAEAEA; padding:15px;" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<!--<h3 class="h3 text-dark">Base de Datos </h3><span class="fa-twitter fa"></span> -->
		<h4 id="titulo_pantalla" class="text-light"><strong>Estructura Presupuestaria</strong></h4>
		<span style="text-align:right" class="contorno fa fa-file-archive-o fa-2x text-light"></span>
	 </div>	<!-- fin div_totulo -->	 	  

    	<section> 	
         <div id="id_container1" class="container border border-info" style="padding:15px;">
            
			<div id="2" class="form-row">
            
			  <div id="3" class="col-2 input-group-sm">
                  <label for="txt_id_estru_presu">Codigo</label>
                  <input name="txt_id_estru_presu"   type="text" disabled = "disabled" class="form-control form-control-sm"  id="txt_id_estru_presu" aria-label="Small" >
			  </div>
                
              <div id="4" class="col-6 input-group-sm">
                    <label for="cbo_id_programa_detalle">Programa Detalle</label>              
					<select id="cbo_id_programa_detalle" class="form-control-sm custom-select" aria-label="Small" name="cbo_id_programa_detalle">
						<option value="">--</option>
						<?PHP 
						$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_BUS_PROGRAMA_DETALLE] null,null,null,null,null,null,null,1";
						$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
						if (! $rst) {  
						   echo "Error en la ejecución de la instrucción ".$qry.".\n";
						   die( print_r2( sqlsrv_errors(), true));  
						   exit;
						}
							while( $rowpro = sqlsrv_fetch_array($rst)) { ?>
							<option value="<?PHP echo $rowpro[0];?>"><?PHP echo $rowpro[1];?></option>
						<?PHP }?>
	
					  </select>
              </div>
                
				<div id="12" class="col-2 input-group-sm">
                  <label for="cbo_periodo">Periodo</label>
                  <select id="cbo_periodo" class="form-control-sm custom-select" aria-label="Small" name="cbo_periodo">
                    <option value="" selected>--</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
					<option value="2021">2021</option>
				  </select>	
                </div>

				<div id="13" class="col-2 input-group-sm">
                  <label for="cbo_estcla">Estcla</label>
                  <select id="cbo_estcla" class="form-control-sm custom-select" aria-label="Small" name="cbo_estcla">
                    <option value="" selected>--</option>
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="C">C</option>
				  </select>	
                </div>					
				
            </div> <!-- fin id=2 --> 
            
			<div id="21" class="form-row">   
				<div id="5" style="padding-top:10px;" class="col-6 input-group-sm">
                  <label for="txt_codestpro1">Codestpro1 </label>
					<input name="txt_codestpro1" type="text" class="form-control form-control-sm" id="txt_codestpro1" maxlength="25" aria-label="Small" onKeyPress="return solonumeros(event)">              				  
                </div>

				<div id="6" style="padding-top:10px;" class="col-6 input-group-sm">
                  <label for="txt_codestpro2">Codestpro2 </label>
					<input name="txt_codestpro2" type="text" class="form-control form-control-sm" id="txt_codestpro2" maxlength="25" aria-label="Small" onKeyPress="return solonumeros(event)">              				  
                </div>

				<div id="7" style="padding-top:10px;" class="col-6 input-group-sm">
                  <label for="txt_codestpro3">Codestpro3 </label>
					<input name="txt_codestpro3" type="text" class="form-control form-control-sm" id="txt_codestpro3" maxlength="25" aria-label="Small" onKeyPress="return solonumeros(event)">              				  
                </div>

				<div id="8" style="padding-top:10px;" class="col-6 input-group-sm">
                  <label for="txt_codestpro4">Codestpro4 </label>
					<input name="txt_codestpro4" type="text" class="form-control form-control-sm" id="txt_codestpro4" maxlength="25" aria-label="Small" onKeyPress="return solonumeros(event)">              				  
                </div>

				<div id="9" style="padding-top:10px;" class="col-6 input-group-sm">
                  <label for="txt_codestpro5">Codestpro5 </label>
					<input name="txt_codestpro5" type="text" class="form-control form-control-sm" id="txt_codestpro5" maxlength="25" aria-label="Small" onKeyPress="return solonumeros(event)">              				  
                </div>

			</div> <!-- fin id=21 --> 
			 
         </div><!-- fin id_container1 -->        
      
        <div id="id_container2" class="container border border-info" style="padding:15px;">
            <div id="div_row" class="form-row">
                <div id="boton1" style="vertical-align:middle" class="col-2">                   
                     <button  id="btn_nuevo" type="button" data-toggle="modal" data-target="#myModal" class="boton boton1 btn btn-outline-dark ">Nuevo</button>   
                </div>
                
                <div id="11" class="w-100"></div>
            
                <div id="boton2" class="col-2">
                    <button id="btn_guardar"  type="button"  data-toggle="modal" data-target="#myModal" class="boton boton2 btn btn-outline-dark ">Guardar</button>   
                </div>                    
                
                <div id="12" class="w-100"></div>
                
                <div id="boton3" class="col-2">
                   <button id="btn_eliminar"  type="button"  data-toggle="modal" data-target="#myModal" class="boton boton3 btn btn-outline-dark ">Eliminar</button>       
                </div>                    
                
                <div id="13" class="w-100"></div>
       
            </div>  
        </div><!-- fin id_container2 -->
       </section>
        
    <div id="id_container3" class="container-fluid border border-info" style="padding:15px;">

        <strong>Lista - Selecione</strong>
        <table class="table table-sm table-bordered  table-hover" style="font-size:12px">
          
            <thead style="background:#3399CC;">
            <tr>
              <th width="39" class="contorno_gris_th tiulo_th" scope="col">Codigo</th>
              <th width="101" class="contorno_gris_th tiulo_th" scope="col">programa_detalle</th>              
              <th width="66" class="contorno_gris_th tiulo_th" scope="col">Codestpro1</th>
			  <th width="66" class="contorno_gris_th tiulo_th" scope="col">Codestpro2</th>
			  <th width="66" class="contorno_gris_th tiulo_th" scope="col">Codestpro3</th>
			  <th width="66" class="contorno_gris_th tiulo_th" scope="col">Codestpro4</th>
			  <th width="66" class="contorno_gris_th tiulo_th" scope="col">Codestpro5</th>
              <th width="44" class="contorno_gris_th tiulo_th" scope="col">Periodo</th>
			  <th width="35" class="contorno_gris_th tiulo_th" scope="col">Estcla</th>
            </tr>
          </thead>
          <tbody>
				<?PHP 
				$qry = "[SP_BUS_ESTRUC_PRESUP] ".$txt_id_estru_presu.",'";
				$qry .= $cbo_id_programa_detalle."','";
				$qry .= $txt_codestpro1."','";
				$qry .= $txt_codestpro2."','";
				$qry .= $txt_codestpro3."','";
				$qry .= $txt_codestpro4."','";
				$qry .= $txt_codestpro5."','";
				$qry .= $cbo_periodo."','";
				$qry .= $cbo_estcla."'";
				//echo $qry.'<br>';
				$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
				if (! $rst) {  
				   echo "Error en la ejecución de la instrucción ".$qry.".\n";
				   die( print_r2( sqlsrv_errors(), true));  
				   exit;
				}
				
				while( $rowusu = sqlsrv_fetch_array( $rst) ) 
				{
				?>				
				   <tr align="center" onClick="javascript:bus_datos( '<?PHP echo $rowusu['id_estru_presu'];?>',
																	 '<?PHP echo $rowusu['id_programa_detalle'];?>',
																	 '<?PHP echo $rowusu['codestpro1'];?>',													 
																	 '<?PHP echo $rowusu['codestpro2'];?>',
																	 '<?PHP echo $rowusu['codestpro3'];?>',
																	 '<?PHP echo $rowusu['codestpro4'];?>',
																	 '<?PHP echo $rowusu['codestpro5'];?>',
																	 '<?PHP echo $rowusu['estcla'];?>',
																	 '<?PHP echo $rowusu['periodo'];?>')">
													 
													 
					  <th class="td_move"><a id="enlace" href="#ir"><?PHP echo $rowusu['id_estru_presu'];?></a></th>
					  <td align="left"   class="td_move"><?PHP echo utf8_encode($rowusu['nombre_detalle']);?></td>
					  <td align="left"   class="td_move"><?PHP echo $rowusu['codestpro1'];?></td>
					  <td align="left"   class="td_move"><?PHP echo $rowusu['codestpro2'];?></td>
					  <td align="left"   class="td_move"><?PHP echo $rowusu['codestpro3'];?></td>					  
					  <td align="left"   class="td_move"><?PHP echo $rowusu['codestpro4'];?></td>
					  <td align="left"   class="td_move"><?PHP echo $rowusu['codestpro5'];?></td>
					  <td align="left"   class="td_move"><?PHP echo $rowusu['periodo'];?></td>
					  <td align="left"   class="td_move"><?PHP echo $rowusu['estcla'];?></td>					  				   </tr>
				   
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
			
function bus_datos(
					id,
					id_programa_detalle,
					txt_codestpro1,
					txt_codestpro2,
					txt_codestpro3,
					txt_codestpro4,
					txt_codestpro5,					
					estcla,
					periodo					
				)
{	
	$("#txt_id_estru_presu").val(id);
	$("#cbo_id_programa_detalle").val(id_programa_detalle);
	$("#txt_codestpro1").val(txt_codestpro1);
	$("#txt_codestpro2").val(txt_codestpro2);
	$("#txt_codestpro3").val(txt_codestpro3);
	$("#txt_codestpro4").val(txt_codestpro4);
	$("#txt_codestpro5").val(txt_codestpro5);	
	$("#cbo_periodo").val(periodo);
	$("#cbo_estcla").val(estcla);
	
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
	url: "../datos/eli_estru_presup.php",
	data:"txt_id_estru_presu="+valor,				 
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
			$('#contenedor').load('../paginas/issg_estru_presup.php');

			
		}else{
			toastr.error('Error Eliminando los datos en  la tabla < Estrutura Presupuestaria > !!!', "Error !!!", {
			"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
			return false;			
		}
	},	
	error: function(error) {				
		alert("Problemas con la pagina eli_estru_presup ... comuniquese con el Personal de Sistemas !!!" + error);
		}		
	});

}

$(document).ready(function(){  

var sv = $(document).scrollTop();

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
		$('#cbo_id_programa_detalle').focus();
		
	//------------------------->
	//PROCESO DE GUARDADO	
	$('#btn_nuevo').on('click', function(){	
		
		desbloquea_caja_nuevo();
		$("#txt_id_estru_presu").val(0);	
		$("#cbo_id_programa_detalle").val('');
		$("#txt_codestpro1").val('');
		$("#txt_codestpro2").val('');
		$("#txt_codestpro3").val('');
		$("#txt_codestpro4").val('');
		$("#txt_codestpro5").val('');
		$("#cbo_periodo").val('');
		$("#cbo_estcla").val('');
	
		$("#cbo_id_programa_detalle").focus();		
	});
	
	
	$('#btn_guardar').on('click', function(){	

		//inicio de validaciones		
		var txt_id_estru_presu			= 	$("#txt_id_estru_presu").val();
		var cbo_id_programa_detalle		= 	$.trim($("#cbo_id_programa_detalle").val());
		var txt_codestpro1				= 	$.trim($("#txt_codestpro1").val());
		var txt_codestpro2				= 	$.trim($("#txt_codestpro2").val());
		var txt_codestpro3				= 	$.trim($("#txt_codestpro3").val());
		var txt_codestpro4				= 	$.trim($("#txt_codestpro4").val());
		var txt_codestpro5				= 	$.trim($("#txt_codestpro5").val());
		var cbo_periodo					= 	$.trim($("#cbo_periodo").val());
		var cbo_estcla					= 	$.trim($("#cbo_estcla").val());
		

		if(txt_id_estru_presu == '')
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
		
		if(cbo_id_programa_detalle == '')
		{
			 bloquea();
			 toastr.error("Error en el Campo -- <b> ESTRUCTURA PRESUPUESTARIA <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#cbo_id_programa_detalle").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;	
		}
		
		if(txt_codestpro1 == '' || txt_codestpro2 == '' || txt_codestpro3 == '' || txt_codestpro4 == '' || txt_codestpro5 == '')
		{
			 bloquea();
			 toastr.error("Error en un Campo -- <b> CODESTPRO <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_codestpro1").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}

		if(cbo_periodo == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b>  PERIODO <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#cbo_periodo").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}
		
		if(cbo_estcla == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> ESTCLA <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#cbo_estcla").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;		
		}
				
			//ajax que guarda y modifica
			$.ajax({
			type: "POST",
			dataType:"html",
			url: "../datos/alm_estru_presup.php",
			data:"txt_id_estru_presu="+$("#txt_id_estru_presu").val()+
			 "&cbo_id_programa_detalle="+$("#cbo_id_programa_detalle").val()+			 
			 "&txt_codestpro1="+$("#txt_codestpro1").val()+
			 "&txt_codestpro2="+$("#txt_codestpro2").val()+
			 "&txt_codestpro3="+$("#txt_codestpro3").val()+
			 "&txt_codestpro4="+$("#txt_codestpro4").val()+
			 "&txt_codestpro5="+$("#txt_codestpro5").val()+
			 "&cbo_periodo="+$("#cbo_periodo").val()+
			 "&cbo_estcla="+$("#cbo_estcla").val(),
			cache: false,			
			success: function(result) {	
			alert(result);			
				if(result == 1){		
						
					bloquea()
					toastr.success('Datos Almacenados con Éxito !!!', "Exito !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_estru_presup.php');							
				
				}else if(result == 2){

					bloquea()
					toastr.success('Datos Actualizados con Éxito !!!', "Exito !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_estru_presup.php');

				}else{
					toastr.error('Error Insertando los datos en  la tabla < Partida Presupuestaria> !!!', "Error !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});
					return false;			
				}		
			},			
			error: function(error) {				
				alert("Problemas con la pagina alm_estru_presup ... comuniquese con el Personal de Sistemas !!!" + error);
				}		
			});	
	});		
		
	$('#btn_eliminar').on('click', function(){
		var valor;
		valor = $('#txt_id_estru_presu').val();		
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
  	$("#cbo_id_programa_detalle").attr("disabled", true);
	$('#txt_codestpro1').attr('disabled','0');	
	$('#txt_codestpro2').attr('disabled','0');	
	$('#txt_codestpro3').attr('disabled','0');	
	$('#txt_codestpro4').attr('disabled','0');	
	$('#txt_codestpro5').attr('disabled','0');	
	$('#cbo_periodo').attr('disabled','0');	
	$('#cbo_estcla').attr('disabled','0');	
}

function desbloquea_caja()
{
    $("#cbo_id_programa_detalle").attr("disabled", false);	
	$('#txt_codestpro1').attr('disabled',false);	
	$('#txt_codestpro2').attr('disabled',false);	
	$('#txt_codestpro3').attr('disabled',false);	
	$('#txt_codestpro4').attr('disabled',false);	
	$('#txt_codestpro5').attr('disabled',false);	
	$('#cbo_periodo').attr('disabled',false);	
	$('#cbo_estcla').attr('disabled',false);	
}

function desbloquea_caja_nuevo()
{
    $("#cbo_id_programa_detalle").attr("disabled", false);	
	$('#txt_codestpro1').attr('disabled',false);	
	$('#txt_codestpro2').attr('disabled',false);	
	$('#txt_codestpro3').attr('disabled',false);	
	$('#txt_codestpro4').attr('disabled',false);	
	$('#txt_codestpro5').attr('disabled',false);	
	$('#cbo_periodo').attr('disabled',false);	
	$('#cbo_estcla').attr('disabled',false);
}
</script>
</body>
</html>