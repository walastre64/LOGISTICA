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

$txt_id_partida = 0;
if(isset($_POST['txt_id_partida'])){
	$txt_id_partida = $_POST['txt_id_partida'];}

$txt_partida_presup = "";
if(isset($_POST['txt_partida_presup'])){
	$txt_partida_presup = $_POST['txt_partida_presup'];}	

$txt_descrip_partida = "";
if(isset($_POST['txt_descrip_partida'])){
	$txt_descrip_partida = $_POST['txt_descrip_partida'];}
	
$cbo_periodo = 0;
if(isset($_POST['cbo_periodo'])){
	$cbo_periodo = $_POST['cbo_periodo'];}
	
$cbo_status = 0;
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
	<div id="divProceso" class="cCargando" style="visibility: hidden;"></div>
		<div style="text-align: center;" id="div_carga">
			<img id="cargador" src="../imagenes/GIF/loading2.gif"/>
		</div>

<div id="1">  <!-- inicio -->

	 <a name="ir"></a>
	 <div id="div_totulo" style="background:#EAEAEA; padding:15px;" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<!--<h3 class="h3 text-dark">Base de Datos </h3><span class="fa-twitter fa"></span> -->
		<h4  id="titulo_pantalla" class="text-light"><strong>Partida Presupuestaria<span class="col-2 input-group-sm"></span></strong></h4>
		<span style="text-align:right" class="contorno fa fa-clone fa-2x text-light"></span>
	 </div>	<!-- fin div_totulo -->	 	  

    	<section> 	
         <div id="id_container1" class="container border border-info" style="padding:15px;">
            
			<div id="2" class="form-row">
            
			  <div id="3" class="col-2 input-group-sm">
                  <label for="txt_id_partida">Codigo</label>
                  <input name="txt_id_partida"   type="text" disabled = "disabled" class="form-control form-control-sm"  id="txt_id_partida" aria-label="Small" >
			  </div>
                
              <div id="4" class="col-7 input-group-sm">
                    <label for="txt_partida_presup">Partida Presup.</label>              
                    <input name="txt_partida_presup" type="text" class="form-control form-control-sm" id="txt_partida_presup" maxlength="11" aria-label="Small" onKeyPress="return solonumeros(event)">      
              </div>
			  
				<div id="6"  class="col-3 input-group-sm">
                  <label for="cbo_periodo">Periodo</label>
                  <select id="cbo_periodo" class="form-control-sm custom-select" aria-label="Small" name="cbo_periodo">
                    <option value="" selected>--</option>
					<?PHP for($i=$ano_menos; $i<=($ano+3); $i++){ ?>
						<option value='<?PHP echo $i;?>'><?PHP echo $i;?></option>
					<?PHP }?>					
				  </select>	
                </div>			  
                
            </div> <!-- fin id=2 --> 
            
			<div id="21" class="form-row">   
				<div id="5" style="padding-top:10px;" class="col-9 input-group-sm">
                  <label for="txt_descrip_partida">Descripción </label>
					<input name="txt_descrip_partida" type="text" class="form-control form-control-sm" id="txt_descrip_partida" maxlength="50" aria-label="Small">              				  
                </div>



                <div id="7" style="padding-top:10px;" class="col-3 input-group-sm">
                  <label for="cbo_status">Status</label>
                  <select id="cbo_status" class="form-control-sm custom-select" aria-label="Small" name="cbo_status">
                    <option value="">--</option>
					<option value="0">Inactivo - 0 </option>
                    <option value="1">Activo - 1</option>
                  </select>
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
        
    <div id="id_container3" class="container-fluid border border-info" style="padding:15px;">

        <strong>Lista - Selecione</strong>
        <table class="table table-sm table-bordered  table-hover" style="font-size:13px">
          
            <thead style="background:#3399CC;">
            <tr>
              <th class="contorno_gris_th tiulo_th" scope="col">Codigo</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Partida Presup.</th>              
              <th class="contorno_gris_th tiulo_th" scope="col">Descripción</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Periodo</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
				<?PHP 
				$qry = "[SP_BUS_PARTIDA_PRESUP] ".$txt_id_partida.",'";
				$qry .= $txt_partida_presup."','";
				$qry .= $txt_descrip_partida."','";
				$qry .= $cbo_periodo."','";
				$qry .= $cbo_status."'";
				$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
				if (! $rst) {  
				   echo "Error en la ejecución de la instrucción ".$qry.".\n";
				   die( print_r2( sqlsrv_errors(), true));  
				   exit;
				}
				
				while( $rowusu = sqlsrv_fetch_array( $rst) ) 
				{
				?>				
				   <tr align="center" onClick="javascript:bus_datos('<?PHP echo $rowusu['id_partida'];?>',
				   						             '<?PHP echo $rowusu['partida_presup'];?>',
													 '<?PHP echo utf8_encode($rowusu['descrip_partida']);?>',
													 '<?PHP echo $rowusu['periodo'];?>',
													 '<?PHP echo $rowusu['status'];?>')">
													 
													 
					  <th class="td_move"><a id="enlace" href="#ir"><?PHP echo $rowusu['id_partida'];?></a></th>
					  <td align="left"   class="td_move"><?PHP echo $rowusu['partida_presup'];?></td>
					  <td align="left"   class="td_move"><?PHP echo utf8_encode($rowusu['descrip_partida']);?></td>
					  <td align="left"   class="td_move"><?PHP echo $rowusu['periodo'];?></td>
					  <td align="center" class="td_move"><?PHP echo $rowusu['status'];?></td>
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
			
function bus_datos(id,partida,descripcion,periodo,status)
{	
	$("#txt_id_partida").val(id);
	$("#txt_partida_presup").val(partida);
	$("#txt_descrip_partida").val(descripcion);
	$("#cbo_periodo").val(periodo);
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
	url: "../datos/eli_partida_presupuestaria.php",
	data:"txt_id_partida="+valor,				 
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
			$('#contenedor').load('../paginas/issg_partida_presupuestaria.php');	  			

			
		}else{
			toastr.error('Error Eliminando los datos en  la tabla < Partida Presupuestaria > !!!', "Error !!!", {
			"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
			return false;			
		}
	},	
	error: function(error) {				
		alert("Problemas con la pagina alm_partida_presup ... comuniquese con el Personal de Sistemas !!!" + error);
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
		$('#txt_partida_presup').focus();
		
	//------------------------->
	//PROCESO DE GUARDADO	
	$('#btn_nuevo').on('click', function(){	
		
		desbloquea_caja_nuevo();
		$("#txt_id_partida").val(0);	
		$("#txt_partida_presup").val('');
		$("#txt_descrip_partida").val('');
		$("#cbo_periodo").val('');
		$("#cbo_status").val('');
	
		$("#txt_partida_presup").focus();		
	});
	
	
	$('#btn_guardar').on('click', function(){	

		//inicio de validaciones		
		var txt_id_partida				= 	$("#txt_id_partida").val();
		var txt_partida_presup			= 	$.trim($("#txt_partida_presup").val());
		var txt_descrip_partida			= 	$.trim($("#txt_descrip_partida").val());
		var cbo_periodo					= 	$.trim($("#cbo_periodo").val());
		var cbo_status					= 	$.trim($("#cbo_status").val());
		

		if(txt_id_partida == '')
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
		
		if(txt_partida_presup == '' ||  txt_partida_presup.length < 2)
		{
			 bloquea();
			 toastr.error("Error en el Campo -- <b> PARTIDA PRESUPUESTARIA <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_partida_presup").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;	
		}
		
		if(txt_descrip_partida == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b>  DESCRIPCIÓN <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_descrip_partida").focus();
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
			url: "../datos/alm_partida_presup.php",
			data:"txt_id_partida="+$("#txt_id_partida").val()+
			 "&txt_partida_presup="+$("#txt_partida_presup").val()+			 
			 "&txt_descrip_partida="+$("#txt_descrip_partida").val()+
			 "&cbo_periodo="+$("#cbo_periodo").val()+
			 "&cbo_status="+$("#cbo_status").val(),
			cache: false,			
			success: function(result) {	
			//alert(result);			
				if(result == 1){		
						
					bloquea()
					toastr.success('Datos Almacenados con Éxito !!!', "Exito !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_partida_presupuestaria.php');							
				
				}else if(result == 2){

					bloquea()
					toastr.success('Datos Actualizados con Éxito !!!', "Exito !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_partida_presupuestaria.php');

				}else{
					toastr.error('Error Insertando los datos en  la tabla < Partida Presupuestaria> !!!', "Error !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});
					return false;			
				}		
			},			
			error: function(error) {				
				alert("Problemas con la pagina alm_partida_presup ... comuniquese con el Personal de Sistemas !!!" + error);
				}		
			});	
	});		
		
	$('#btn_eliminar').on('click', function(){
		var valor;
		valor = $('#txt_id_partida').val();		
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
  	$("#txt_partida_presup").attr("disabled", true);
	$('#txt_descrip_partida').attr('disabled','0');	
	$('#cbo_periodo').attr('disabled','0');	
	$('#cbo_status').attr('disabled','0');	
}

function desbloquea_caja()
{
    $("#txt_partida_presup").attr("disabled", false);	
	$('#txt_descrip_partida').attr('disabled',false);	
	$('#cbo_periodo').attr('disabled',false);	
	$('#cbo_status').attr('disabled',false);	
}

function desbloquea_caja_nuevo()
{
    $("#txt_partida_presup").attr("disabled", false);	
	$('#txt_descrip_partida').attr('disabled',false);	
	$('#cbo_periodo').attr('disabled',false);	
	$('#cbo_status').attr('disabled',false);
}
</script>
</body>
</html>