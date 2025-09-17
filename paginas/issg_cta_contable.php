<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE');
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
session_valida();
$conn = conectate();
$ano = date("Y");
$ano_menos = ($ano - 1);

$txt_id_cta = 0;
if(isset($_POST['txt_id_cta'])){
	$txt_id_cta = $_POST['txt_id_cta'];}

$txt_cta_contable = "";
if(isset($_POST['txt_cta_contable'])){
	$txt_cta_contable = $_POST['txt_cta_contable'];}	
	
$txt_descrip_cta_contable = "";
if(isset($_POST['txt_descrip_cta_contable'])){
	$txt_descrip_cta_contable = $_POST['txt_descrip_cta_contable'];}
	
$cbo_periodo = "";
if(isset($_POST['cbo_periodo'])){
	$cbo_periodo = $_POST['cbo_periodo'];}		

$txt_status = "";
if(isset($_POST['txt_status'])){
	$txt_status = $_POST['txt_status'];}

/*
$txt_tipo = "";
if(isset($_POST['txt_tipo'])){
	$txt_tipo = $_POST['txt_tipo'];}
*/	
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

<div id="1"> <!-- inicio -->	
 
	 <div id="div_totulo" style="background:#EAEAEA; padding:15px;" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h4 id="titulo_pantalla" class="text-light"><strong>Cuentas Contables</strong></h4>
		<span style="text-align:right;" class="contorno fa fa-book fa-2x text-light"></span>
	 </div>	<!-- fin div_totulo -->	 	  

    	<section> 	
         <div id="id_container1" class="container border border-info" style="padding:15px;">
            <div id="2" class="form-row">
              <div id="3" class="col-1 input-group-sm">
                  <label for="txt_id_bd">Codigo</label>
                  <input name="txt_id_cta"   type="text" disabled = "disabled" class="form-control form-control-sm"  id="txt_id_cta" aria-label="Small" >
              </div>

                <div id="4" class="col-5 input-group-sm">
                    <label for="txt_nombre_bd">Cuenta Contable</label>              
                    <input name="txt_cta_contable" type="text" class="form-control form-control-sm" id="txt_cta_contable" maxlength="18" onKeyPress="return solonumeros(event)" aria-label="Small">              
                </div>
				
                <div id="5" class="col-6 input-group-sm">
                    <label for="txt_ruta_bd">Descripcion Cuenta</label>              
                    <input name="txt_descrip_cta_contable" type="text" class="form-control form-control-sm" id="txt_descrip_cta_contable" maxlength="250" aria-label="Small">              
                </div>	
				
              <div id="6" style="padding-top:15px;" class="col-4 input-group-sm">
                    <label for="cbo_periodo">Periodo</label>  
                    <select name="cbo_periodo" id="cbo_periodo"  class="form-control-sm custom-select" aria-label="Small">
                      <option value="0" selected>--</option>
					<?PHP for($i=$ano_menos; $i<=($ano); $i++){ ?>
						<option value='<?PHP echo $i;?>'><?PHP echo $i;?></option>
					<?PHP }?>
                    </select>
                    </label>
                </div>							

                <div id="7" style="padding-top:15px;" class="col-4 input-group-sm">
                    <label for="txt_staus">Status</label>              
					  <select id="txt_status" class="form-control-sm custom-select" aria-label="Small" name="txt_status">
						<option value="">--</option>
						<option value="0">Inactivo</option>
						<option value="1">Activo</option>
					  </select>                    
                </div>							
               
			    <!--
				<div id="8" style="padding-top:15px;" class="col-4 input-group-sm">
                    <label for="txt_tipo">Tipo</label>              
					  <select id="txt_tipo" class="form-control-sm custom-select" aria-label="Small" name="txt_tipo">
					   <option value="">--</option>
						<option value=0>0</option>				   
						<option value=1>1</option>
						<option value=2>2</option>
						<option value=3>3</option>
					  </select>                    
                </div>				  
                --> 
                
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
        <table class="table table-sm table-bordered table-hover" style="font-size:12px">
          
            <thead style="background:#3399CC;">
            <tr>
              <th class="contorno_gris_th tiulo_th" scope="col">Codigo</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Cta Contab.</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Descip.</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Periodo</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Status</th>
			  <!-- <th class="contorno_gris_th tiulo_th" scope="col">Tipo</th> -->
            </tr>
          </thead>
		  
          <tbody>
				<?PHP 
				$qry = "SP_BUS_CTAS_CONTABLE ".$txt_id_cta.",'".$txt_cta_contable."',0,0,0";
				$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
				if (! $rst) {  
				   echo "Error en la ejecución de la instrucción ".$qry.".\n";
				   die( print_r2( sqlsrv_errors(), true));  
				   exit;
				}
				
				while( $rowusu = sqlsrv_fetch_array( $rst) ) 
				{
				?>				
				   <tr onClick="javascript:bus_datos('<?PHP echo $rowusu['id_cta_contable'];?>','<?PHP echo $rowusu['cta_contable'];?>','<?PHP echo utf8_decode(utf8_encode($rowusu['descrip_cta_contable']));?>','<?PHP echo $rowusu['periodo'];?>','<?PHP echo $rowusu['status'];?>','<?PHP echo $rowusu['tipo'];?>')" align="center" scope="row">
					  <th align="center" scope="row" class="td_move"><?PHP echo $rowusu['id_cta_contable'];?></th>
					  <td align="center" scope="row" class="td_move"><?PHP echo $rowusu['cta_contable'];?></td>
					  <td align="left"   scope="row" class="td_move"><?PHP echo utf8_decode(utf8_encode($rowusu['descrip_cta_contable']));?></td>
					  <td class="td_move"><?PHP echo $rowusu['periodo'];?></td>
					  <td class="td_move"><?PHP echo $rowusu['status'];?></td>
					  <!--<td class="td_move"><?PHP echo $rowusu['tipo'];?></td> -->
					</tr>
				<?PHP
				}	  
				sqlsrv_free_stmt( $rst );  
				sqlsrv_close( $conn );
				?>
          </tbody>
        </table>        
    </div><!-- fin id_container3 -->    
    
    
</div> <!--  -->
</div>	<!-- fin inicio -->


<script>
			
function bus_datos(id,cta,descripcion,periodo,status,tipo)
{
	$("#txt_id_cta").val(id);
	$("#txt_cta_contable").val(cta);
	$("#txt_descrip_cta_contable").val(descripcion);
	$("#cbo_periodo").val(periodo);
	$("#txt_status").val(status);
	$("#txt_tipo").val(tipo);	

	if(id > 0)
		desbloquea_caja();		

	$("#txt_cta_contable").focus();		
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
	url: "../datos/eli_cta_contable.php",
	data:"txt_id_bd="+valor,				 
    beforeSend: function(){    	    
    },	
	cache: false,			
	success: function(result) {	
		//alert(result);
		if(result == 1){

			$('.modal-backdrop').hide();
			$("body").removeClass("modal-open");
			
			bloquea()
			toastr.success('Datos Eliminados con Exito !!!', "Mensaje !!!", {
			"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});
			setTimeout(function(){ desbloquea();}, 5000);			

			$("#contenedor").empty();
			$('#contenedor').load('../paginas/issg_cta_contable.php');

			
		}else{
			toastr.error('Error Eliminando los datos en  la tabla < ISSG_CTA_CONTABLE > !!!', "Error !!!", {
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
	$('#txt_cta_contable').focus();
		
	//------------------------->
	//PROCESO DE GUARDADO	
	$('#btn_nuevo').on('click', function(){	
		
		desbloquea_caja();
		$("#txt_id_cta").val(0);	
		$("#txt_cta_contable").val('');
		$("#txt_descrip_cta_contable").val('');
		$("#cbo_periodo").val('');
		$("#txt_status").val('');
		//$("#txt_tipo").val('');
		$("#txt_cta_contable").focus();
		
	});
	
	
	$('#btn_guardar').on('click', function(){	

		//inicio de validaciones		
		var txt_id_cta					= 	$("#txt_id_cta").val();
		var txt_cta_contable			= 	$.trim($("#txt_cta_contable").val()) 	;
		var txt_descrip_cta_contable	= 	$.trim($("#txt_descrip_cta_contable").val());
		var cbo_periodo					= 	$.trim($("#cbo_periodo").val());
		var txt_status					= 	$.trim($("#txt_status").val());
		//var txt_tipo					= 	$.trim($("#txt_tipo").val());		

		if(txt_id_cta == '')
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
		
		if(txt_cta_contable == '' ||  txt_cta_contable.length < 4)
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> CTA CONTABLE <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_cta_contable").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;	
		}
		
		if(txt_descrip_cta_contable == '' ||  txt_descrip_cta_contable.length < 4)
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> DESCRIPCION CTA CONTABLE <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_descrip_cta_contable").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;	
		}		
		
		if(cbo_periodo == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> PERIODO <b/> --", "Error !!!", {
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
		
	/*
		if(txt_tipo == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> TIPO <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_tipo").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}
	*/	
		
			//ajax que guarda y modifica
			$.ajax({
			type: "POST",
			dataType:"html",
			url: "../datos/alm_cta_contable.php",
			data:"txt_id_cta="+$("#txt_id_cta").val()+
			 "&txt_cta_contable="+$("#txt_cta_contable").val()+
			 "&txt_descrip_cta_contable="+$("#txt_descrip_cta_contable").val()+
			 "&cbo_periodo="+$("#cbo_periodo").val()+
			 "&txt_status="+$("#txt_status").val(),
			 //"&txt_tipo="+$("#txt_tipo").val(),
			cache: false,			
			success: function(result) {	
			resultado=result.split("/");
			//alert(result);
			
				if(resultado[0] == 1){						
					bloquea();
					toastr.success('Datos Almacenados con Exito !!!', "Mensaje !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_cta_contable.php');
				
				}else if(resultado[0] == 2){

					bloquea()
					toastr.success('Numero de cuenta Contable Existente !!! para el codigo < '+ resultado[1] +' >', "Mensaje !!!", {
					"showDuration": "150","hideDuration": "1500","timeOut": "4000","extendedTimeOut": "2000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 10000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_cta_contable.php');
				
				}else if(resultado[0] == 3){
					bloquea();
					toastr.success('Datos Actualizados con Exito !!!', "Mensaje !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_cta_contable.php');							

				}else{
					toastr.error('Error Insertando los datos en  la tabla < Cta Contable > !!!', "Error !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"        		});	
					$("#txt_password").focus();
					return false;			
				}		
			},			
			error: function(error) {				
				alert("Problemas con la pagina ALM_CTA_CONTABLE ... comuniquese con el Personal de Sistemas !!!" + error);
				}		
			});	

	});		
		
	$('#btn_eliminar').on('click', function(){
		var valor;
		valor = $('#txt_id_cta').val();
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
	$("#txt_id_cta").attr("disabled", true);
	$("#txt_cta_contable").attr("disabled", true);
	$("#txt_descrip_cta_contable").attr("disabled", true);	
	$('#cbo_periodo').attr('disabled','0');	
	$('#txt_status').attr('disabled','0');	
	$('#txt_tipo').attr('disabled','0');	
}

function desbloquea_caja()
{
	$("#txt_cta_contable").attr("disabled", false);
	$("#txt_descrip_cta_contable").attr("disabled", false);	
	$('#cbo_periodo').attr('disabled',false);	
	$('#txt_status').attr('disabled',false);	
	$('#txt_tipo').attr('disabled',false);	
}


</script>
</body>
</html>