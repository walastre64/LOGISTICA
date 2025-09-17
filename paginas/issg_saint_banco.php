<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE');
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
session_valida();
$conn = conectate();

$txt_id_saint_banco = 0;
if(isset($_POST['txt_id_saint_banco'])){
	$txt_id_saint_banco = $_POST['txt_id_saint_banco'];}

$txt_nombre_banco = "";
if(isset($_POST['txt_nombre_banco'])){
	$txt_nombre_banco = $_POST['txt_nombre_banco'];}	
	
$txt_codigo_banco = "";
if(isset($_POST['txt_codigo_banco'])){
	$txt_codigo_banco = $_POST['txt_codigo_banco'];}	

$txt_codigo_Saint = "";
if(isset($_POST['txt_codigo_Saint'])){
	$txt_codigo_Saint = $_POST['txt_codigo_Saint'];}

$txt_codemp = "";
if(isset($_POST['txt_codemp'])){
	$txt_codemp = $_POST['txt_codemp'];}
	
$txt_codban = "";
if(isset($_POST['txt_codban'])){
	$txt_codban = $_POST['txt_codban'];}
	
$txt_ctaban = "";
if(isset($_POST['txt_ctaban'])){
	$txt_ctaban = $_POST['txt_ctaban'];}
	
$txt_ctabanext = "";
if(isset($_POST['txt_ctabanext'])){
	$txt_ctabanext = $_POST['txt_ctabanext'];}	

$txt_dencta = "";
if(isset($_POST['txt_dencta'])){
	$txt_dencta = $_POST['txt_dencta'];}
	
$cbo_sc_cuenta = "";
if(isset($_POST['cbo_sc_cuenta'])){
	$cbo_sc_cuenta = $_POST['cbo_sc_cuenta'];}

$cbo_status = 2;
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

	

<div id="div_alerta"></div>

	<div id="divProceso" class="cCargando" style="visibility: hidden;"></div>
		<div style="text-align: center;" id="div_carga">
			<img id="cargador" src="../imagenes/GIF/loading2.gif"/>
		</div>

<div id="1"> <!-- inicio -->		
 
	 <div id="div_totulo" style="background:#EAEAEA; padding:15px;" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<!--<h3 class="h3 text-dark">Base de Datos </h3><span class="fa-twitter fa"></span> -->
		<h4 id="titulo_pantalla" class="text-light"><strong>Saint - Banco</strong></h4>
		<span style="text-align:right" class="contorno fa fa-check-square fa-2x text-light"></span>
	 </div>	<!-- fin div_totulo -->	 	  

    	<section> 	
         <div id="id_container1" class="container border border-info" style="padding:15px;">
            <div id="2" class="form-row">
              <div id="3" class="col-2 input-group-sm">
                  <label for="txt_id_saint_banco">Codigo</label>
                  <input name="txt_id_saint_banco"   type="text" disabled = "disabled" class="form-control form-control-sm"  id="txt_id_saint_banco" aria-label="Small" >
                  <label for="txt_codigo_banco">
                  <input name="txt_codigo_banco" type="hidden" value="">
                  </label>
              </div>
                
                <div id="4" class="col-7 input-group-sm">
                    <label for="txt_nombre_banco">Nombre Banco</label>              
                    <input  name="txt_nombre_banco" type="text" class="form-control form-control-sm" id="txt_nombre_banco" maxlength="150" aria-label="Small" onKeyUp="javascript:this.value=this.value.toUpperCase();">              
                </div>

				<div id="6" class="col-2 input-group-sm">
					<label for="txt_codemp">Cod. Empresa</label>              
					<input name="txt_codemp" type="text" class="form-control form-control-sm" id="txt_codemp" maxlength="4" aria-label="Small" onKeyPress="return solonumeros(event)">              
				</div>				
				
				<div id="5"  class="col-9 input-group-sm">
					<label for="txt_codigo_Saint">Codigo Saint</label>              
					<input name="txt_codigo_Saint" type="text" class="form-control form-control-sm" id="txt_codigo_Saint" maxlength="80" aria-label="Small" onKeyPress="return solonumeros(event)">              
				</div>

				<div id="7"  class="col-2 input-group-sm">
				  <label for="txt_codban">Cod. Banco</label>
				  <input name="txt_codban" type="text" class="form-control form-control-sm" id="txt_codban" maxlength="20" aria-label="Small" onKeyPress="return solonumeros(event)">              
				</div> 

		
			<div id="21" class="form-row"> 
					
					<div id="8" style="padding-top:10px;" class="col-5 input-group-sm">
					  <label for="txt_ctaban">Cuenta Banco</label>
					  <input name="txt_ctaban" type="text" class="form-control form-control-sm" id="txt_ctaban" maxlength="20" aria-label="Small" onKeyPress="return solonumeros(event)">              
					</div> 
					
					<div id="9" style="padding-top:10px;" class="col-4 input-group-sm">
					  <label for="txt_ctabanext">Codigo Banco Externo</label>
					  <input name="txt_ctabanext" type="text" class="form-control form-control-sm" id="txt_ctabanext" maxlength="20" aria-label="Small" onKeyPress="return solonumeros(event)">              
					</div>

					<div id="12" style="padding-top:10px;"  class="col-2 input-group-sm">
					  <label for="cbo_status">Status</label>
					  <select id="cbo_status" class="form-control-sm custom-select" aria-label="Small" name="cbo_status">
						<option value="">--</option>
						<option value="0">Inactivo - 0 </option>
						<option value="1">Activo - 1</option>
					  </select>
					</div>									
			
					<div id="10" style="padding-top:10px;" class="col-5 input-group-sm">
					  <label for="txt_dencta">Den. Cta</label>
					  <input name="txt_dencta" type="text" class="form-control form-control-sm" id="txt_dencta" maxlength="80" aria-label="Small" onKeyPress="return solonumeros(event)">              
					</div>		
				
				<div id="11" style="padding-top:10px;" class="col-6 input-group-sm">
                  <label for="cbo_sc_cuenta">SC Contable </label>
                  <select id="cbo_sc_cuenta" class="form-control-sm custom-select" aria-label="Small" name="cbo_sc_cuenta">
                    <option value="">--</option>
					<?PHP
					$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_BUS_CTAS_CONTABLE] 0,'',0,1,1";
					$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
					if (! $rst) {  
					   echo "Error en la ejecución de la instrucción ".$qry.".\n";
					   die( print_r2( sqlsrv_errors(), true));  
					   exit;
					}
						while( $rowti = sqlsrv_fetch_array($rst)) { ?>
						<option value="<?PHP echo $rowti[0];?>"><?PHP echo $rowti[1].'-'. utf8_encode($rowti[2]);?></option>
					<?PHP }?>

                  </select>
                </div>
					
					
					
							                
                
            </div>  
		</div> <!-- fin id=21 --> 
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
        
    <div id="id_container3" class="container-fluid border border-info" style="padding:15px; font-size:12px" >

        <strong>Lista - Selecione</strong>
        <table class="table table-sm table-bordered  table-hover">
          
            <thead style="background:#3399CC;">
            <tr>
              <th class="contorno_gris_th tiulo_th" scope="col">Codigo</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Nombre Banco</th>              
			  <th class="contorno_gris_th tiulo_th" scope="col">Cod. Saint</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Cod. Empresa</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Cod. Banco</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Cta. Banco Ext.</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Den Cta</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Sc. Cta.</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
				<?PHP 
				$qry = "[SP_BUS_SAINT_BANCO] ".$txt_id_saint_banco.",'";
				$qry .= $txt_nombre_banco."','";				
				$qry .= $txt_codigo_Saint."','";	
				$qry .= $txt_codemp."','";	
				$qry .= $txt_codban."','";	
				$qry .= $txt_ctaban."','";	
				$qry .= $txt_ctabanext."','";	
				$qry .= $txt_dencta."','";	
				$qry .= $cbo_sc_cuenta."',";	
				$qry .= $cbo_status."";		

				$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
				if (! $rst) {  
				   echo "Error en la ejecución de la instrucción ".$qry.".\n";
				   die( print_r2( sqlsrv_errors(), true));  
				   exit;
				}
				
				while( $rowusu = sqlsrv_fetch_array( $rst) ) 
				{
				?>				
				   <tr onClick="javascript:bus_datos('<?PHP echo $rowusu['id_saint_banco'];?>',
													 '<?PHP echo utf8_encode($rowusu['nombre_banco']);?>',
													 '<?PHP echo $rowusu['codigo_Saint'];?>',
													 '<?PHP echo $rowusu['codemp'];?>',
													 '<?PHP echo $rowusu['codban'];?>',
													 '<?PHP echo $rowusu['ctaban'];?>',
													 '<?PHP echo $rowusu['ctabanext'];?>',
													 '<?PHP echo utf8_encode($rowusu['dencta']);?>',
													 '<?PHP echo $rowusu['sc_cuenta'];?>',
													 '<?PHP echo $rowusu['estatus'];?>')">
														
					  <th class="td_move" align="center" scope="row"><?PHP echo $rowusu['id_saint_banco'];?></th>
					  <td class="td_move"><?PHP echo utf8_encode($rowusu['nombre_banco']);?></td>
					  <td class="td_move"><?PHP echo $rowusu['codigo_Saint'];?></td>
					  <td class="td_move"><?PHP echo $rowusu['codemp'];?></td>
					  <td class="td_move"><?PHP echo $rowusu['codban'];?></td>
					 <!-- <td class="td_move"><?PHP //echo $rowusu['ctaban'];?></td> -->
					  <td class="td_move"><?PHP echo $rowusu['ctabanext'];?></td>
					  <td class="td_move"><?PHP echo utf8_encode($rowusu['dencta']);?></td>
					  <td class="td_move"><?PHP echo $rowusu['sc_cuenta'];?></td>
					  <td class="td_move"><?PHP echo $rowusu['estatus'];?></td>
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
			
function bus_datos(id,
				   nombre,
				   codigo_Saint,
				   codemp,
				   codban,
				   ctaban,
				   ctabanext,
				   dencta,
				   sc_cuenta,
				   status)
{	
	
	$("#txt_id_saint_banco").val(id);
	$("#txt_nombre_banco").val(nombre);
	//$("#txt_codigo_banco").val(codigo_banco);
	$("#txt_codigo_Saint").val(codigo_Saint);
	$("#txt_codemp").val(codemp);	
	$("#txt_codban").val(codban);
	$("#txt_ctaban").val(ctaban);	
	$("#txt_ctabanext").val(ctabanext);
	$("#txt_dencta").val(dencta);
	$("#cbo_sc_cuenta").val(sc_cuenta);
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
	url: "../datos/eli_saint_banco.php.php",
	data:"txt_id_saint_banco="+valor,				 
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
			$('#contenedor').load('../paginas/issg_saint_banco.php');

			
		}else{
			toastr.error('Error Eliminando los datos en  la tabla < Saint Banco > !!!', "Error !!!", {
			"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
			return false;			
		}
	},	
	error: function(error) {				
		alert("Problemas con la pagina eli_saint_banco ... comuniquese con el Personal de Sistemas !!!" + error);
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
		$('#txt_nombre_banco').focus();
	  //$("#txt_codigo_banco").focus();
		
	//------------------------->
	//PROCESO DE GUARDADO	
	$('#btn_nuevo').on('click', function(){	
		
		desbloquea_caja_nuevo();
		$("#txt_id_saint_banco").val(0);	
		$("#txt_nombre_banco").val('');
		$("#txt_codigo_banco").val('');
		$("#txt_codigo_Saint").val('');
		$("#txt_codemp").val('');	
		$("#txt_codban").val('');	
		$("#txt_ctaban").val('');		
		$("#txt_dencta").val('');
		$("#txt_ctabanext").val('');			
		$("#cbo_sc_cuenta").val('');
		$("#cbo_status").val('');
		
		$("#txt_nombre_banco").focus();		
	});
	
	
	$('#btn_guardar').on('click', function(){	

		//inicio de validaciones		
		var txt_id_saint_banco		= $("#txt_id_saint_banco").val();
		var txt_nombre_banco		= $.trim($("#txt_nombre_banco").val());
		var txt_codigo_banco		= $.trim($("#txt_codigo_banco").val());
		var txt_codigo_Saint		= $.trim($("#txt_codigo_Saint").val());
		var txt_codemp				= $.trim($("#txt_codemp").val());
		var txt_codban				= $.trim($("#txt_codban").val());
		var txt_ctaban				= $.trim($("#txt_ctaban").val());		
		var txt_ctabanext			= $.trim($("#txt_ctabanext").val());
		var txt_dencta				= $.trim($("#txt_dencta").val());
		var cbo_sc_cuenta			= $.trim($("#cbo_sc_cuenta").val());
		var cbo_status				= $.trim($("#cbo_status").val());


		if(txt_id_saint_banco == '')
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
		
		if(txt_nombre_banco == '' ||  txt_nombre_banco.length < 4)
		{
			 bloquea();
			 toastr.error("Error en el Campo -- <b> NOMBRE BANCO <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_nombre_banco").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;	
		}
		
		if(txt_codigo_Saint == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> CODIGO SAINT <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_codigo_Saint").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;		
		}
		
		if(txt_codemp == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> COD. EMPRESA <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_codemp").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}

		if(txt_ctaban == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> CTA. BCO <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_ctaban").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}
		
		if(txt_ctabanext == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> CTA. BCO EXT. <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_ctabanext").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}
		
		if(txt_dencta == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> DEN. CTA. <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_dencta").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}
		
		
		if(cbo_sc_cuenta == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> SC Cuenta <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#cbo_sc_cuenta").focus();
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
			url: "../datos/alm_saint_banco.php",
			data:"txt_id_saint_banco="+$("#txt_id_saint_banco").val()+
			 "&txt_nombre_banco="+$("#txt_nombre_banco").val()+
			 "&txt_codigo_banco="+$("#txt_codigo_banco").val()+
			 "&txt_codigo_Saint="+$("#txt_codigo_Saint").val()+
			 "&txt_codemp="+$("#txt_codemp").val()+
			 "&txt_ctaban="+$("#txt_ctaban").val()+			 
			 "&txt_ctabanext="+$("#txt_ctabanext").val()+			 
			 "&txt_dencta="+$("#txt_dencta").val()+
			 "&cbo_sc_cuenta="+$("#cbo_sc_cuenta").val()+
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
					$('#contenedor').load('../paginas/issg_saint_banco.php');							
				
				}else{
					toastr.error('Error Insertando los datos en  la tabla < Saint - Banco > !!!', "Error !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"        		});	
					$("#txt_password").focus();
					return false;			
				}		
			},			
			error: function(error) {				
				alert("Problemas con la pagina alm_saint_banco ... comuniquese con el Personal de Sistemas !!!" + error);
				}		
			});	
	});		
		
	$('#btn_eliminar').on('click', function(){
		var valor;
		valor = $('#txt_id_saint_banco').val();		
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
  	$("#txt_nombre_banco").attr("disabled", true);
	$("#txt_codigo_banco").attr("disabled", true);
	$('#txt_codigo_Saint').attr('disabled','0');	
	$('#txt_codemp').attr('disabled','0');	
	$("#txt_ctaban").attr('disabled','0');
	$("#txt_codban").attr("disabled", true);	
	$("#txt_ctaban").attr("disabled", true);
	$("#txt_ctabanext").attr("disabled", true);
	$("#txt_dencta").attr("disabled", true);
	$("#cbo_sc_cuenta").attr("disabled", true);
	$("#cbo_status").attr("disabled", true);	
}

function desbloquea_caja()
{
  //$("#txt_nombre_banco").attr("disabled", false);
    $("#txt_nombre_banco").attr("disabled", true);
	$("#txt_codigo_banco").attr("disabled", false);
	$('#txt_codigo_Saint').attr('disabled',false);	
	$('#txt_codemp').attr('disabled',false);
	$('#txt_ctaban').attr('disabled',false);	
	$('#txt_codban').attr('disabled',false);
	
	$('#txt_ctabanext').attr('disabled',false);
	$('#txt_dencta').attr('disabled',false);	
	$('#cbo_sc_cuenta').attr('disabled',false);	
	$('#cbo_status').attr('disabled',false);		
}

function desbloquea_caja_nuevo()
{
    $("#txt_nombre_banco").attr("disabled", false);
	$("#txt_codigo_banco").attr("disabled", false);
	$('#txt_codigo_Saint').attr('disabled',false);	
	$('#txt_codemp').attr('disabled',false);	
	$('#txt_ctaban').attr('disabled',false);	
	$('#txt_codban').attr('disabled',false);
	$('#txt_ctabanext').attr('disabled',false);
	$('#txt_dencta').attr('disabled',false);	
	$('#cbo_sc_cuenta').attr('disabled',false);	
	$('#cbo_status').attr('disabled',false);	
				
}
</script>
</body>
</html>