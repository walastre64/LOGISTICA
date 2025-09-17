<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE');
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
session_valida();
$conn = conectate();

$txt_id_programa_detalle = 0;
if(isset($_POST['txt_id_programa_detalle'])){
	$txt_id_programa_detalle = $_POST['txt_id_programa_detalle'];}

$txt_nombre_detalle = "";
if(isset($_POST['txt_nombre_detalle'])){
	$txt_nombre_detalle = $_POST['txt_nombre_detalle'];}	

$cbo_id_programa = "";
if(isset($_POST['cbo_id_programa'])){
	$cbo_id_programa = $_POST['cbo_id_programa'];}
	
$cbo_id_bd = "";
if(isset($_POST['cbo_id_bd'])){
	$cbo_id_bd = $_POST['cbo_id_bd'];}
	
$cbo_id_sucu = "";
if(isset($_POST['cbo_id_sucu'])){
	$cbo_id_sucu = $_POST['cbo_id_sucu'];}
	
$cbo_cta_ingreso = "";
if(isset($_POST['cbo_cta_ingreso'])){
	$cbo_cta_ingreso = $_POST['cbo_cta_ingreso'];}
	
$cbo_cta_debito_fiscal = "";
if(isset($_POST['cbo_cta_debito_fiscal'])){
	$cbo_cta_debito_fiscal = $_POST['cbo_cta_debito_fiscal'];}		

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

<div id="div_alerta"></div>

	<div id="divProceso" class="cCargando" style="visibility: hidden;"></div>
		<div style="text-align: center;" id="div_carga">
			<img id="cargador" src="../imagenes/GIF/loading2.gif"/>
		</div>

<div id="1"> <!-- inicio -->	
 
	 <div id="div_totulo" style="background:#EAEAEA; padding:15px;" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<!--<h3 class="h3 text-dark">Base de Datos </h3><span class="fa-twitter fa"></span> -->
		<h4 id="titulo_pantalla" class="text-light"><strong>Programas Detalle</strong></h4>
		<span style="text-align:right" class="contorno fa fa-address-book fa-2x text-light"></span>
	 </div>	<!-- fin div_totulo -->	 	  

    	<section> 	
         <div id="id_container1" class="container border border-info" style="padding:15px;">
            
			<div id="2" class="form-row">
            
			  <div id="3" class="col-2 input-group-sm">
                  <label for="txt_id_programa_detalle">Codigo</label>
                  <input name="txt_id_programa_detalle"   type="text" disabled = "disabled" class="form-control form-control-sm"  id="txt_id_programa_detalle" aria-label="Small" >
              </div>
                
              <div id="4" class="col-7 input-group-sm">
                    <label for="txt_nombre_detalle">Nombre Detalle</label>              
                    <input name="txt_nombre_detalle" type="text" class="form-control form-control-sm" id="txt_nombre_detalle" maxlength="50" aria-label="Small">              
              </div>
			  
				<div id="5" class="col-3 input-group-sm">
                  <label for="cbo_id_programa">Programa</label>
                  <select id="cbo_id_programa" class="form-control-sm custom-select" aria-label="Small" name="cbo_id_programa">
                    <option value="">--</option>
					<?PHP 
					$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_BUS_PROGRAMA] 0,'',1";
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
				
				<div id="8" style="padding-top:10px;" class="col-9 input-group-sm">
                  <label for="cbo_cta_ingreso">Cta Ingreso</label>
                  <select id="cbo_cta_ingreso" class="form-control-sm custom-select" aria-label="Small" name="cbo_cta_ingreso">
                    <option value="">--</option>
					<?PHP 
					$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_BUS_CTAS_CONTABLE] 0,'',0,1,1";
					$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
					if (! $rst) {  
					   echo "Error en la ejecución de la instrucción ".$qry.".\n";
					   die( print_r2( sqlsrv_errors(), true));  
					   exit;
					}
						while( $rowctain = sqlsrv_fetch_array($rst)) { ?>
						<option value="<?PHP echo $rowctain[1];?>"><?PHP echo $rowctain[1].'-'.$rowctain[2];?></option>
					<?PHP }?>

                  </select>
                </div>	
				
				<div id="6" style="padding-top:10px;" class="col-3 input-group-sm">
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
						<option value="<?PHP echo $rowbd[0];?>"><?PHP echo $rowbd[5];?></option>
					<?PHP }?>

                  </select>
                </div>
							
						  
                
            </div> <!-- fin id=2 --> 
            
			<div id="21" class="form-row">   
			
				<div id="7" style="padding-top:10px;" class="col-6 input-group-sm">
                  <label for="cbo_id_sucu">Sucursal</label>
                  <select id="cbo_id_sucu" class="form-control-sm custom-select" aria-label="Small" name="cbo_id_sucu">
                    <option value="">--</option>
					<?PHP 
					$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_BUS_SUCURSAL] 0,''";
					$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
					if (! $rst) {  
					   echo "Error en la ejecución de la instrucción ".$qry.".\n";
					   die( print_r2( sqlsrv_errors(), true));  
					   exit;
					}
						while( $rowsu = sqlsrv_fetch_array($rst)) { ?>
						<option value="<?PHP echo $rowsu[0];?>"><?PHP echo $rowsu[1];?></option>
					<?PHP }?>

                  </select>
                </div>				


				<div id="9" style="padding-top:10px;" class="col-3 input-group-sm">
                  <label for="cbo_cta_debito_fiscal">Cta Debito Fiscal</label>
                  <select id="cbo_cta_debito_fiscal" class="form-control-sm custom-select" aria-label="Small" name="cbo_cta_debito_fiscal">
                    <option value="">--</option>
					<?PHP 
					$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_BUS_CTAS_CONTABLE] 0,'',0,1,3";
					$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
					if (! $rst) {  
					   echo "Error en la ejecución de la instrucción ".$qry.".\n";
					   die( print_r2( sqlsrv_errors(), true));  
					   exit;
					}
						while( $rowctafi = sqlsrv_fetch_array($rst)) { ?>
						<option value="<?PHP echo $rowctafi[1];?>"><?PHP echo $rowctafi[1].'-'.$rowctafi[2];?></option>
					<?PHP }?>

                  </select>
                </div>				

                           
                <div id="10" style="padding-top:10px;" class="col-3 input-group-sm">
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
        <table class="table table-sm table-bordered  table-hover" style="font-size:12px">
          
            <thead style="background:#3399CC;">
            <tr>
              <th class="contorno_gris_th tiulo_th" scope="col">Codigo</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Nombre detalle</th>              
              <th class="contorno_gris_th tiulo_th" scope="col">Programa</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Base Datos</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Sucursal</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Cta Ingreso</th>			  
              <th class="contorno_gris_th tiulo_th" scope="col">Cta Debito F.</th>			  			  			  
			  <th class="contorno_gris_th tiulo_th" scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
				<?PHP 
				$qry = "[SP_BUS_PROGRAMA_DETALLE] ".$txt_id_programa_detalle.",'";
				$qry .= $txt_nombre_detalle."','";
				$qry .= $cbo_id_programa."','";
				$qry .= $cbo_id_bd."','";
				$qry .= $cbo_id_sucu."','";
				$qry .= $cbo_cta_ingreso."','";
				$qry .= $cbo_cta_debito_fiscal."','";
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
				   <tr align="center" id="tr_data" onClick="javascript:bus_datos('<?PHP echo $rowusu['id_programa_detalle'];?>',
				   						             '<?PHP echo utf8_encode($rowusu['nombre_detalle']);?>',
													 '<?PHP echo $rowusu['id_programa'];?>',
													 '<?PHP echo $rowusu['id_bd'];?>',
													 '<?PHP echo $rowusu['id_sucu'];?>',
													 '<?PHP echo $rowusu['cta_ingreso'];?>',
													 '<?PHP echo $rowusu['cta_debito_fiscal'];?>',
													 '<?PHP echo $rowusu['status'];?>')">
													 
													 
					  <th class="td_move"><?PHP echo $rowusu['id_programa_detalle'];?></th>
					  <td align="left" class="td_move"><?PHP echo utf8_encode($rowusu['nombre_detalle']);?></td>
					  <td align="left" class="td_move"><?PHP echo utf8_encode($rowusu['nombre_programa']);?></td>
					  <td align="left" class="td_move"><?PHP echo $rowusu['nombre_bd'];?></td>
					  <td align="left" class="td_move"><?PHP echo $rowusu['nombre_sucu'];?></td>
					  <td align="left" class="td_move"><?PHP echo $rowusu['cta_ingreso'];?></td>
					  <td align="left" class="td_move"><?PHP echo $rowusu['cta_debito_fiscal'];?></td>
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
			
function bus_datos(id,nombre,programa,bd,sucursal,cta_ingreso,cta_debito,status)
{	
	$("#txt_id_programa_detalle").val(id);
	$("#txt_nombre_detalle").val(nombre);
	$("#cbo_id_programa").val(programa);
	$("#cbo_id_bd").val(bd);
	$("#cbo_id_sucu").val(sucursal);
	$("#cbo_cta_ingreso").val(cta_ingreso);
	$("#cbo_cta_debito_fiscal").val(cta_debito);	
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
	url: "../datos/eli_programa_detalle.php",
	data:"txt_id_programa_detalle="+valor,				 
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
			$('#contenedor').load('../paginas/issg_programa_detalle.php');	  			

			
		}else{
			toastr.error('Error Eliminando los datos en  la tabla < Programa Detalle > !!!', "Error !!!", {
			"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
			return false;			
		}
	},	
	error: function(error) {				
		alert("Problemas con la pagina alm_programa_detalle ... comuniquese con el Personal de Sistemas !!!" + error);
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
		$('#txt_nombre_detalle').focus();
		
	//------------------------->
	//PROCESO DE GUARDADO	
	$('#btn_nuevo').on('click', function(){	
		
		desbloquea_caja_nuevo();
		$("#txt_id_programa_detalle").val(0);	
		$("#txt_nombre_detalle").val('');
		$("#cbo_id_programa").val('');
		$("#cbo_id_bd").val('');
		$("#cbo_id_sucu").val('');
		$("#cbo_cta_ingreso").val('');
		$("#cbo_cta_debito_fiscal").val('');
		$("#cbo_status").val('');
	
		$("#txt_nombre_detalle").focus();		
	});
	
	
	$('#btn_guardar').on('click', function(){	

		//inicio de validaciones		
		var txt_id_programa_detalle		= 	$("#txt_id_programa_detalle").val();
		var txt_nombre_detalle			= 	$.trim($("#txt_nombre_detalle").val());
		var cbo_id_programa				= 	$.trim($("#cbo_id_programa").val());
		var cbo_id_bd					= 	$.trim($("#cbo_id_bd").val());
		var cbo_id_sucu					= 	$.trim($("#cbo_id_sucu").val());
		var cbo_cta_ingreso				= 	$.trim($("#cbo_cta_ingreso").val());
		var cbo_cta_debito_fiscal		= 	$.trim($("#cbo_cta_debito_fiscal").val());
		var cbo_status					= 	$.trim($("#cbo_status").val());
		

		if(txt_id_programa_detalle == '')
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
		
		if(txt_nombre_detalle == '' ||  txt_nombre_detalle.length < 2)
		{
			 bloquea();
			 toastr.error("Error en el Campo -- <b> NOMBRE DETALLE <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#nombre_programa").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;	
		}
		
		if(cbo_id_programa == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b>  PROGRAMA <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#cbo_id_programa").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}

		if(cbo_id_bd == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b>  BASE DE DATOS <b/> --", "Error !!!", {
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
		
		if(cbo_id_sucu == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> SUCURSAL <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#cbo_id_sucu").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}		

		if(cbo_cta_ingreso == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> CTA INGRESOS <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#cbo_cta_ingreso").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}
		
		if(cbo_cta_debito_fiscal == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> CTA DEBITO FISCAL <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#cbo_cta_debito_fiscal").focus();
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
			url: "../datos/alm_programa_detalle.php",
			data:"txt_id_programa_detalle="+$("#txt_id_programa_detalle").val()+
			 "&txt_nombre_detalle="+$("#txt_nombre_detalle").val()+			 
			 "&cbo_id_programa="+$("#cbo_id_programa").val()+
			 "&cbo_id_bd="+$("#cbo_id_bd").val()+
			 "&cbo_id_sucu="+$("#cbo_id_sucu").val()+
			 "&cbo_cta_ingreso="+$("#cbo_cta_ingreso").val()+
			 "&cbo_cta_debito_fiscal="+$("#cbo_cta_debito_fiscal").val()+			 
			 "&cbo_status="+$("#cbo_status").val()+
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
					$('#contenedor').load('../paginas/issg_programa_detalle.php');							
				
				}else if(result == 2){

					bloquea()
					toastr.success('Datos Actualizados con Éxito !!!', "Exito !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_programa_detalle.php');

				}else{
					toastr.error('Error Insertando los datos en  la tabla < Programa Detalle> !!!', "Error !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});
					return false;			
				}		
			},			
			error: function(error) {				
				alert("Problemas con la pagina alm_programa_datalle ... comuniquese con el Personal de Sistemas !!!" + error);
				}		
			});	
	});		
		
	$('#btn_eliminar').on('click', function(){
		var valor;
		valor = $('#txt_id_programa_detalle').val();		
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
  	$("#txt_nombre_detalle").attr("disabled", true);
	$('#cbo_id_programa').attr('disabled','0');	
	$('#cbo_id_bd').attr('disabled','0');	
	$('#cbo_id_sucu').attr('disabled','0');	
	$('#cbo_cta_ingreso').attr('disabled','0');	
	$('#cbo_cta_debito_fiscal').attr('disabled','0');	
	$('#cbo_status').attr('disabled','0');	
}

function desbloquea_caja()
{
    $("#txt_nombre_detalle").attr("disabled", false);	
	$('#cbo_id_programa').attr('disabled',false);	
	$('#cbo_id_bd').attr('disabled',false);	
	$('#cbo_id_sucu').attr('disabled',false);	
	$('#cbo_cta_ingreso').attr('disabled',false);	
	$('#cbo_cta_debito_fiscal').attr('disabled',false);			
	$('#cbo_status').attr('disabled',false);	
}

function desbloquea_caja_nuevo()
{
    $("#txt_nombre_detalle").attr("disabled", false);	
	$('#cbo_id_programa').attr('disabled',false);	
	$('#cbo_id_bd').attr('disabled',false);	
	$('#cbo_id_sucu').attr('disabled',false);	
	$('#cbo_cta_ingreso').attr('disabled',false);	
	$('#cbo_cta_debito_fiscal').attr('disabled',false);		
	$('#cbo_status').attr('disabled',false);
}
</script>
</body>
</html>