<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE');
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
session_valida();
$conn = conectate();

$txt_id_aso_contab_presup = 0;
if(isset($_POST['txt_id_aso_contab_presup'])){
	$txt_id_aso_contab_presup = $_POST['txt_id_aso_contab_presup'];}

$txt_codinst = 0;
if(isset($_POST['txt_codinst'])){
	$txt_codinst = $_POST['txt_codinst'];}	

$txt_descrip = '';
if(isset($_POST['txt_descrip'])){
	$txt_descrip = $_POST['txt_descrip'];}
	
$cbo_servicio_producto = 2; // VALOR > 2 EN LA BD PARA ENCONRALOS TODOS
if(isset($_POST['cbo_servicio_producto'])){
	$cbo_servicio_producto = $_POST['cbo_servicio_producto'];}
	
$cbo_sigla_serie = 0;
if(isset($_POST['cbo_sigla_serie'])){
	$cbo_sigla_serie = $_POST['cbo_sigla_serie'];}
	
$cbo_id_cta_contable = 0;
if(isset($_POST['cbo_id_cta_contable'])){
	$cbo_id_cta_contable = $_POST['cbo_id_cta_contable'];}
	
$cbo_id_partida = 0;
if(isset($_POST['cbo_id_partida'])){
	$cbo_id_partida = $_POST['cbo_id_partida'];}		

$cbo_id_bd = 0;
if(isset($_POST['cbo_id_bd'])){
	$cbo_id_bd = $_POST['cbo_id_bd'];}		

$cbo_codinst_ppal = 0;
if(isset($_POST['cbo_codinst_ppal'])){
	$cbo_codinst_ppal = $_POST['cbo_codinst_ppal'];}		

$cbo_activo  = 2; // VALOR > 2 EN LA BD PARA ENCONRALOS TODOS
if(isset($_POST['cbo_activo'])){
	$cbo_activo = $_POST['cbo_activo'];}		

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

<div id="1"> <!-- inicio -->		

<div id="div_alerta"></div>

	<div id="divProceso" class="cCargando" style="visibility: hidden;"></div>
		<div style="text-align: center;" id="div_carga">
			<img id="cargador" src="../imagenes/GIF/loading2.gif"/>
		</div>

<div id="1"> <!-- inicio -->	

 	<a name="ir"></a>
	 <div id="div_totulo" style="background:#EAEAEA; padding:15px;" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<!--<h3 class="h3 text-dark">Base de Datos </h3><span class="fa-twitter fa"></span> -->
		<h4 id="titulo_pantalla" class="text-light"><strong>Asociar. Ctas Contable Presup.</strong></h4>
		<span style="text-align:right" class="contorno fa fa-check fa-2x text-light"></span>
	 </div>	<!-- fin div_totulo -->	 	  

    	<section> 	
         <div id="id_container1" class="container border border-info" style="padding:15px;">
            
			<div id="2" class="form-row">
            
			  <div id="3" class="col-2 input-group-sm">
                  <label for="txt_id_aso_contab_presup">Código</label>
                  <input name="txt_id_aso_contab_presup"   type="text" disabled = "disabled" class="form-control form-control-sm"  id="txt_id_aso_contab_presup" aria-label="Small" >
              </div>
                
              <div id="4" class="col-2 input-group-sm">
                    <label for="txt_codinst">Instancia</label>              
  					<input id="txt_codinst" maxlength="2" type="number" class="form-control form-control-sm" aria-label="Small" name="txt_codinst" value="0" min="1" max="100" step="1" onKeyPress="return solonumeros(event)">
                <!-- el value debe ser el ultimo registrado + 1 -->
	          </div>
			  
       			<div id="6"  class="col-6 input-group-sm">
                  <label for="cbo_servicio_producto">Servicio Producto</label>
                  <select id="cbo_servicio_producto" class="form-control-sm custom-select" aria-label="Small" name="cbo_servicio_producto">
                    <option value="">--</option>
					<option value="0">Productos - 0 </option>
                    <option value="1">Servicios - 1</option>
                  </select>
                </div>	
			  
		    </div> <!-- fin id=2 --> 
            


			<div id="21" class="form-row">   
				
				<div id="5" style="padding-top:10px;" class="col-10 input-group-sm">
					<label for="txt_descrip">Descripción</label>
					<input name="txt_descrip"   type="text"  class="form-control form-control-sm"  id="txt_descrip" maxlength="40" aria-label="Small" >
				</div>
				
				<div id="7" style="padding-top:10px;" class="col-10 input-group-sm">
                  <label for="cbo_id_cta_contable">Cuenta Contable </label>
                  <select id="cbo_id_cta_contable" class="form-control-sm custom-select" aria-label="Small" name="cbo_id_cta_contable">
                    <option value="">--</option>
					<?PHP
					$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_BUS_CTAS_CONTABLE] 0,'',0,1,2";
					$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
					if (! $rst) {  
					   echo "Error en la ejecución de la instrucción ".$qry.".\n";
					   die( print_r2( sqlsrv_errors(), true));  
					   exit;
					}
						while( $rowti = sqlsrv_fetch_array($rst)) { ?>
						<option value="<?PHP echo $rowti[0];?>"><?PHP echo $rowti[1].' - '.$rowti[2];?></option>
					<?PHP }?>

                  </select>
                </div>

				<div id="8" style="padding-top:10px;" class="col-10 input-group-sm">
                  <label for="cbo_id_partida">Partida Presupuestaria </label>
                  <select id="cbo_id_partida" class="form-control-sm custom-select" aria-label="Small" name="cbo_id_partida">
                    <option value="">--</option>
					<?PHP
					$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_BUS_PARTIDA_PRESUP] 0,'','',0,2";
					$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
					if (! $rst) {  
					   echo "Error en la ejecución de la instrucción ".$qry.".\n";
					   die( print_r2( sqlsrv_errors(), true));  
					   exit;
					}
						while( $rowti = sqlsrv_fetch_array($rst)) { ?>
						<option value="<?PHP echo $rowti[0];?>"><?PHP echo $rowti[1].' - '.$rowti[2];?></option>
					<?PHP }?>

                  </select>
                </div>				
              
			  	<div id="4" style="padding-top:10px;" class="col-3 input-group-sm">
                    <label for="txt_codinst">Instancia Ppal.</label>              
  					<input id="cbo_codinst_ppal" type="number" class="form-control form-control-sm" aria-label="Small" name="cbo_codinst_ppal" value="0" min="1" max="100" step="1" onKeyPress="return solonumeros(event)">
                <!-- el value debe ser el ultimo registrado + 1 -->
	          	</div>	
				
				
				<div id="15" style="padding-top:10px;"  class="col-4 input-group-sm">
                  <label for="cbo_id_bd">Base de Datos</label>
                  <select id="cbo_id_bd" class="form-control-sm custom-select" aria-label="Small" name="cbo_id_bd">
                    <option value="">--</option>
					<?PHP 
					$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_BUS_BASE_DATO] 0,'',1";
					$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
					if (! $rst) {  
					   echo "Error en la ejecución de la instrucción ".$qry.".\n";
					   die( print_r2( sqlsrv_errors(), true));  
					   exit;
					}
						while( $rowbd = sqlsrv_fetch_array($rst)) { ?>
						<option value="<?PHP echo $rowbd[0];?>"><?PHP echo $rowbd[2];?></option>
					<?PHP }?>

                  </select>

                </div>					

          		<div id="12" style="padding-top:10px;"  class="col-3 input-group-sm">
                  <label for="cbo_activo">Status</label>
                  <select id="cbo_activo" class="form-control-sm custom-select" aria-label="Small" name="cbo_activo">
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
                
                <div id="13" class="w-100"></div>
            
                <div id="boton2" class="col-2">
                    <button id="btn_guardar"  type="button"  data-toggle="modal" data-target="#myModal" class="boton boton2 btn btn-outline-dark ">Guardar</button>   
                </div>                    
                
                <div id="14" class="w-100"></div>
                
                <div id="boton3" class="col-2">
                   <button id="btn_eliminar"  type="button"  data-toggle="modal" data-target="#myModal" class="boton boton3 btn btn-outline-dark ">Eliminar</button>       
                </div>                    
                
                <div id="15" class="w-100"></div>
       
            </div>  
        </div><!-- fin id_container2 -->
       </section>
        
    <div id="id_container3" class="container-fluid border border-info" style="padding:15px;">

        <strong>Lista - Seleccione</strong>
        <table class="table table-sm table-bordered  table-hover" style="font-size:12px">
          
            <thead style="background:#3399CC;">
            <tr>
              <th class="contorno_gris_th tiulo_th" scope="col">Código</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Codinst</th>              
              <th class="contorno_gris_th tiulo_th" scope="col">Descrip.</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Servicio Producto</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Cta Contable</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Partida </th>			  
              <th class="contorno_gris_th tiulo_th" scope="col">BD</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Codinst Ppal</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Activo</th>
            </tr>
          </thead>
          <tbody>
				<?PHP 
				//echo   "[SP_BUS_ASOC_CONTAB_PRESU_INSTA] 0,0,'',2,0,0,0,0,2"."<br>";
				$qry = "[SP_BUS_ASOC_CONTAB_PRESU_INSTA] ".$txt_id_aso_contab_presup.",";
				$qry .= $txt_codinst.",'";
				$qry .= $txt_descrip."',";
				$qry .= $cbo_servicio_producto.",";
				$qry .= $cbo_id_cta_contable.",";
				$qry .= $cbo_id_partida.",";
				$qry .= $cbo_id_bd.",";
				$qry .= $cbo_codinst_ppal.",";
				$qry .= $cbo_activo."";
				//echo $qry;
				$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
				if (! $rst) {  
				   echo "Error en la ejecución de la instrucción ".$qry.".\n";
				   die( print_r2( sqlsrv_errors(), true));  
				   exit;
				}
				
				while( $rowusu = sqlsrv_fetch_array( $rst) ) 
				{
				?>				
				   <tr align="center" id="tr_data" onClick="javascript:bus_datos('<?PHP echo $rowusu['id_aso_contab_presup'];?>',
				   						             '<?PHP echo $rowusu['codinst'];?>',
													 '<?PHP echo utf8_encode($rowusu['descrip']);?>',
													 '<?PHP echo $rowusu['servicio_producto'];?>',
													 '<?PHP echo $rowusu['id_cta_contable'];?>',
													 '<?PHP echo $rowusu['id_partida'];?>',
													 '<?PHP echo $rowusu['id_bd'];?>',													 
													 '<?PHP echo $rowusu['codinst_ppal'];?>',
													 '<?PHP echo $rowusu['activo'];?>')">
													 
													 
					  <th 				 class="td_move"><a id="enlace" href="#ir"><?PHP echo $rowusu['id_aso_contab_presup'];?></a></th>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['codinst'];?></td>
					  <td align="left" 	 class="td_move"><?PHP echo utf8_encode($rowusu['descrip']);?></td>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['servicio_producto'];?></td>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['id_cta_contable'];?></td>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['id_partida'];?></td>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['id_bd'];?></td>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['codinst_ppal'];?></td>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['activo'];?></td>
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
		
function bus_datos (
	id,
	codinst,
	descrip,
	servicio_producto,
	id_cta_contable,
	id_partida,
	id_bd,
	codinst_ppal,
	activo
)
{	
	$("#txt_id_aso_contab_presup").val(id);
	$("#txt_codinst").val(codinst);
	$("#txt_descrip").val(descrip);
	$("#cbo_servicio_producto").val(servicio_producto);
	$("#cbo_id_cta_contable").val(id_cta_contable);
	$("#cbo_id_partida").val(id_partida);
	$("#cbo_id_bd").val(id_bd);
	$("#cbo_codinst_ppal").val(codinst_ppal);
	$("#cbo_activo").val(activo);	

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
	url: "../datos/eli_aso_contb_presup.php",
	data:"txt_id_aso_contab_presup="+valor,				 
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
			$('#contenedor').load('../paginas/issg_aso_contab_presu.php');	  			

			
		}else{
			toastr.error('Error Eliminando los datos en  la tabla < Asoc. Contab. Presup. > !!!', "Error !!!", {
			"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
			return false;			
		}
	},	
	error: function(error) {				
		alert("Problemas con la pagina alm_aso_contab_presup ... comuniquese con el Personal de Sistemas !!!" + error);
		}		
	});

}

$(document).ready(function(){  

var posicion_scroll = $("#1").offset().top;

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
		$('#txt_descrip').focus();
		
	//------------------------->
	//PROCESO DE GUARDADO	
	$('#btn_nuevo').on('click', function(){	
		
		desbloquea_caja_nuevo();
		$("#txt_id_aso_contab_presup").val(0);	
		$("#txt_codinst").val('');
		$("#txt_descrip").val('');
		$("#cbo_servicio_producto").val('');
		$("#cbo_id_cta_contable").val('');
		$("#cbo_id_partida").val('');
		$("#cbo_id_bd").val('');		
		$("#cbo_codinst_ppal").val('');
		$("#cbo_activo").val('');
	
		$("#txt_descrip").focus();		
	});
	
	
	$('#btn_guardar').on('click', function(){	

		//inicio de validaciones		
		var txt_id_aso_contab_presup	= 	$("#txt_id_aso_contab_presup").val();
		var txt_codinst					= 	$.trim($("#txt_codinst").val());
		var txt_descrip					= 	$.trim($("#txt_descrip").val());
		var cbo_servicio_producto		= 	$.trim($("#cbo_servicio_producto").val());		
		var cbo_id_cta_contable			= 	$.trim($("#cbo_id_cta_contable").val());
		var cbo_id_partida				= 	$.trim($("#cbo_id_partida").val());
		var cbo_id_bd					= 	$.trim($("#cbo_id_bd").val());		
		var cbo_codinst_ppal			= 	$.trim($("#cbo_codinst_ppal").val());
		var cbo_activo					= 	$.trim($("#cbo_activo").val());
			

		if(txt_id_aso_contab_presup == '')
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
		
		if(txt_codinst == '' )
		{
			 bloquea();
			 toastr.error("Error en el Campo -- <b> CODIGO INSTANCIA <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_codinst").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;	
		}
		
		if(cbo_servicio_producto == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b>  SERVICIO PRODUCTO <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#cbo_servicio_producto").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}

		if(cbo_id_cta_contable == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> CUENTA CONTABLE <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#cbo_id_cta_contable").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}
		
			if(cbo_id_partida == '')
			{
				 bloquea();
				 toastr.error("Error en en Campo -- <b> PARTIDA <b/> --", "Error !!!", {
				  "showDuration": "50",
				  "hideDuration": "500",
				  "timeOut": "2000",
				  "extendedTimeOut": "1000",
				  "preventDuplicates": true,
				  "onclick": null,
				  "progressBar": true,
				  "positionClass": "toast-bottom-full-width"
				});	
				$("#cbo_id_partida").focus();
				setTimeout(function(){ desbloquea();}, 2000);
				return false;				
			}

		if(cbo_id_bd == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> BASE DE DATOS <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#cbo_id_bd").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}
		
		
			if(cbo_codinst_ppal == '')
			{
				 bloquea();
				 toastr.error("Error en en Campo -- <b> INSTANCIAS PPAL. <b/> --", "Error !!!", {
				  "showDuration": "50",
				  "hideDuration": "500",
				  "timeOut": "2000",
				  "extendedTimeOut": "1000",
				  "preventDuplicates": true,
				  "onclick": null,
				  "progressBar": true,
				  "positionClass": "toast-bottom-full-width"
				});	
				$("#cbo_codinst_ppal").focus();
				setTimeout(function(){ desbloquea();}, 2000);
				return false;				
			}


		if(cbo_activo == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> ACTIVO <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#cbo_activo").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;		
		}
				
			//ajax que guarda y modifica
			$.ajax({
			type: "POST",
			dataType:"html",
			url: "../datos/alm_aso_contb_presu.php",
			data:"txt_id_aso_contab_presup="+$("#txt_id_aso_contab_presup").val()+
			 "&txt_codinst="+$("#txt_codinst").val()+			 
			 "&txt_descrip="+$("#txt_descrip").val()+
			 "&cbo_servicio_producto="+$("#cbo_servicio_producto").val()+
			 "&cbo_id_cta_contable="+$("#cbo_id_cta_contable").val()+
			 "&cbo_id_partida="+$("#cbo_id_partida").val()+
			 "&cbo_id_bd="+$("#cbo_id_bd").val()+	
			 "&cbo_codinst_ppal="+$("#cbo_codinst_ppal").val()+			 
			 "&cbo_activo="+$("#cbo_activo").val(),
			cache: false,			
			success: function(result) {	
			//alert(result);			
				if(result == 1){		
						
					bloquea()
					toastr.success('Datos Almacenados con Éxito !!!', "Exito !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_aso_contab_presu.php');							
				
				}else if(result == 2){

					bloquea()
					toastr.success('Datos Actualizados con Éxito !!!', "Exito !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_aso_contab_presu.php');

				}else{
					toastr.error('Error Insertando los datos en  la tabla < Asoc. Contab. Presup> !!!', "Error !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});
					return false;			
				}		
			},			
			error: function(error) {				
				alert("Problemas con la pagina alm_aso_contab_presup ... comuniquese con el Personal de Sistemas !!!" + error);
				}		
			});	
	});		
		
	$('#btn_eliminar').on('click', function(){
		var valor;
		valor = $('#txt_id_aso_contab_presup').val();		
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
  	$("#txt_codinst").attr("disabled", '0');
	$('#txt_descrip').attr('disabled','0');	
	$("#cbo_servicio_producto").attr('disabled','0');
	$('#cbo_id_cta_contable').attr('disabled','0');	
	$('#cbo_id_partida').attr('disabled','0');	
	$('#cbo_id_bd').attr('disabled','0');	
	$('#cbo_codinst_ppal').attr('disabled','0');
	$('#cbo_activo').attr('disabled','0');
}

function desbloquea_caja()
{
    $("#txt_codinst").attr("disabled", false);	
	$('#txt_descrip').attr('disabled',false);	
	$('#cbo_servicio_producto').attr('disabled',false);	
	$('#cbo_id_cta_contable').attr('disabled',false);	
	$('#cbo_id_partida').attr('disabled',false);	
	$('#cbo_id_bd').attr("disabled", false);
	$('#cbo_codinst_ppal').attr("disabled", false);
	$('#cbo_activo').attr("disabled", false);
}

function desbloquea_caja_nuevo()
{
    $("#txt_codinst").attr("disabled", false);	
	$('#txt_descrip').attr('disabled',false);	
	$('#cbo_servicio_producto').attr('disabled',false);	
	$('#cbo_id_cta_contable').attr('disabled',false);	
	$('#cbo_id_partida').attr('disabled',false);	
	$('#cbo_id_bd').attr("disabled", false);
	$('#cbo_codinst_ppal').attr("disabled", false);
	$('#cbo_activo').attr("disabled", false);
}
</script>
</body>
</html>