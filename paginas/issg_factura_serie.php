<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE');
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
session_valida();
$conn = conectate();

$txt_id_serie = 0;
if(isset($_POST['txt_id_serie'])){
	$txt_id_serie = $_POST['txt_id_serie'];}

$cbo_descripcion_bd = '';
if(isset($_POST['cbo_descripcion_bd'])){
	$cbo_descripcion_bd = $_POST['cbo_descripcion_bd'];}	

$cbo_id_programa_detalle = 0;
if(isset($_POST['cbo_id_programa_detalle'])){
	$cbo_id_programa_detalle = $_POST['cbo_id_programa_detalle'];}
	
$cbo_tipo_impresora = 0;
if(isset($_POST['cbo_tipo_impresora'])){
	$cbo_tipo_impresora = $_POST['cbo_tipo_impresora'];}
	
$cbo_sigla_serie = "";
if(isset($_POST['cbo_sigla_serie'])){
	$cbo_sigla_serie = $_POST['cbo_sigla_serie'];}
	
$cbo_codigo_impresoraF = "";
if(isset($_POST['cbo_codigo_impresoraF'])){
	$cbo_codigo_impresoraF = $_POST['cbo_codigo_impresoraF'];}
	
$cbo_cod_vendedor = "";
if(isset($_POST['cbo_cod_vendedor'])){
	$cbo_cod_vendedor = $_POST['cbo_cod_vendedor'];}		

$txt_cod_ubicacion = "";
if(isset($_POST['txt_cod_ubicacion'])){
	$txt_cod_ubicacion = $_POST['txt_cod_ubicacion'];}		

$txt_cod_operacion = "";
if(isset($_POST['txt_cod_operacion'])){
	$txt_cod_operacion = $_POST['txt_cod_operacion'];}		

$txt_codigo_Serie = "";
if(isset($_POST['txt_codigo_Serie'])){
	$txt_codigo_Serie = $_POST['txt_codigo_Serie'];}		

$cbo_status = 0;
if(isset($_POST['cbo_status'])){
	$cbo_status = $_POST['cbo_status'];}
	
$txt_codigo_serie_BD = '';
if(isset($_POST['txt_codigo_serie_BD'])){
	$txt_codigo_serie_BD = $_POST['txt_codigo_serie_BD'];}
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
	<div>	
 	<a name="ir"></a>
	 <div id="div_totulo" style="background:#EAEAEA; padding:15px;" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<!--<h3 class="h3 text-dark">Base de Datos </h3><span class="fa-twitter fa"></span> -->
		<h4 id="titulo_pantalla" class="text-light"><strong>Facturas Series</strong></h4>
		<span style="text-align:right" class="contorno fa fa-folder-o fa-2x text-light"></span>
	 </div>	<!-- fin div_totulo -->	 	  

    	<section> 	
         <div id="id_container1" class="container border border-success" style="padding:15px;">
            
			<div id="2" class="form-row">
            
			  <div id="3" class="col-2 input-group-sm">
                  <label for="txt_id_serie">Código</label>
                  <input name="txt_id_serie"   type="text" disabled = "disabled" class="form-control form-control-sm"  id="txt_id_serie" aria-label="Small" >
              </div>
                
              <div id="4" class="col-7 input-group-sm">
                    <label for="cbo_descripcion_bd">Descripción Base Datos</label>              
				<select id="cbo_descripcion_bd"  class="form-control-sm custom-select" aria-label="Small" name="cbo_descripcion_bd">
                    <option value="">--</option>
					<?PHP 
					$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_BUS_BASE_DATO] 0,'',1";
					$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
					if (! $rst) {  
					   echo "Error en la ejecución de la instrucción ".$qry.".\n";
					   die( print_r2( sqlsrv_errors(), true));  
					   exit;
					}
						$contador = 0;
						while( $rowbd = sqlsrv_fetch_array($rst)) { 
						$contador = $contador + 1; ?>
						<option value="<?PHP echo $rowbd[2].'-'.$rowbd[6];?>"><?PHP echo '<b>'.$rowbd[2].'</b>'.' - '.$rowbd[5];?></option>						
					<?PHP }?>
					
                </select>
                <label>
                
                </label>
                <label>
                <input name="txt_codigo_Serie_bd" type="hidden" id="txt_codigo_Serie_bd" value="">
                </label>
              </div>
                
                <div id="12"  class="col-3 input-group-sm">
                  <label for="cbo_status">Status</label>
                  <select id="cbo_status" class="form-control-sm custom-select" aria-label="Small" name="cbo_status">
                    <option value="">--</option>
					<option value="0">Inactivo - 0 </option>
                    <option value="1">Activo - 1</option>
                  </select>
                </div>				
           
		    </div> <!-- fin id=2 --> 
            
			<div id="21" class="form-row">   
				<div id="5" style="padding-top:10px;" class="col-6 input-group-sm">
                  <label for="cbo_id_programa_detalle">Programa Detalle </label>
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
						while( $rowpd = sqlsrv_fetch_array($rst)) { ?>
						<option value="<?PHP echo $rowpd[0];?>"><?PHP echo $rowpd[1];?></option>
					<?PHP }?>

                  </select>
                </div>

				<div id="6" style="padding-top:10px;" class="col-6 input-group-sm">
                  <label for="cbo_tipo_impresora">Tipo de Impresora </label>
                  <select id="cbo_tipo_impresora" class="form-control-sm custom-select" aria-label="Small" name="cbo_tipo_impresora">
                    <option value="">--</option>
					<?PHP 
					$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_BUS_TIPO_IMPRESORA] 0,'',1";
					$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
					if (! $rst) {  
					   echo "Error en la ejecución de la instrucción ".$qry.".\n";
					   die( print_r2( sqlsrv_errors(), true));  
					   exit;
					}
						while( $rowti = sqlsrv_fetch_array($rst)) { ?>
						<option value="<?PHP echo $rowti[0];?>"><?PHP echo $rowti[1];?></option>
					<?PHP }?>

                  </select>
                </div>
				
				<div id="7" style="padding-top:10px;" class="col-4 input-group-sm">
                  <label for="txt_sigla_serie">Sigla Serie</label>
                  <input name="txt_sigla_serie" type="text" class="form-control form-control-sm" id="txt_sigla_serie" maxlength="10" aria-label="Small" onKeyUp="javascript:this.value=this.value.toUpperCase();" onKeyPress="javascript:return AlphaNumCheck(event)">
                </div>
				
				<div id="8" style="padding-top:10px;" class="col-4 input-group-sm">
                  <label for="txt_codigo_impresoraF">Cod. Impresora F.</label>
				  <input name="txt_codigo_impresoraF" type="text" class="form-control form-control-sm" id="txt_codigo_impresoraF" maxlength="10" aria-label="Small" onKeyUp="javascript:this.value=this.value.toUpperCase();" onKeyPress="javascript:return AlphaNumCheck(event)">
                </div>				

				<div id="9" style="padding-top:10px;" class="col-4 input-group-sm">
                  <label for="txt_cod_vendedor">Cod. Vendedor</label>
				  <input name="txt_cod_vendedor" type="text" class="form-control form-control-sm" id="txt_cod_vendedor" maxlength="10" aria-label="Small" onKeyUp="javascript:this.value=this.value.toUpperCase();" onKeyPress="javascript:return AlphaNumCheck(event)">              
				</div>	

				<div id="10" style="padding-top:10px;" class="col-4 input-group-sm">
                  <label for="txt_cod_ubicacion">Cod. Ubicación</label>
				  <input name="txt_cod_ubicacion" type="text" class="form-control form-control-sm" id="txt_cod_ubicacion" maxlength="10" aria-label="Small" onKeyUp="javascript:this.value=this.value.toUpperCase();" onKeyPress="javascript:return AlphaNumCheck(event)">              
				</div>			  			

				<div id="11" style="padding-top:10px;" class="col-4 input-group-sm">
                  <label for="txt_cod_operacion">Cod. Operador </label>
				  <input name="txt_cod_operacion" type="text" class="form-control form-control-sm" id="txt_cod_operacion" maxlength="10" aria-label="Small" onKeyUp="javascript:this.value=this.value.toUpperCase();" onKeyPress="javascript:return AlphaNumCheck(event)">              
				</div>			  			

				<div id="12" style="padding-top:10px;" class="col-4 input-group-sm">
                  <label for="txt_codigo_Serie">Cod Serie</label>
				  <input name="txt_codigo_Serie" type="text" class="form-control form-control-sm" id="txt_codigo_Serie" maxlength="10" aria-label="Small" onKeyUp="javascript:this.value=this.value.toUpperCase();" onKeyPress="javascript:return AlphaNumCheck(event)">
                </div>	

			</div> <!-- fin id=21 --> 
			 
         </div><!-- fin id_container1 -->        
      
        <div id="id_container2" class="container border border-success" style="padding:15px;">
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
        
    <div id="id_container3" class="container-fluid border border-success" style="padding:15px;">

        <strong>Lista - Seleccione</strong>
        <table class="table table-sm table-bordered  table-hover" style="font-size:12px">
          
            <thead class="bg-info">
            <tr>
              <th class="contorno_gris_th tiulo_th" scope="col">Código</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Descripción</th>              
              <th class="contorno_gris_th tiulo_th" scope="col">Programa Detalle</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Tipo Impresora</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Siglas Series</th>
              <th class="contorno_gris_th tiulo_th" scope="col">Cod. Impresora </th>			  
              <th class="contorno_gris_th tiulo_th" scope="col">Cod. Vendedor</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Cod. Ubicación</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Cod. Operación</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Cod. Serie</th>
			  <th class="contorno_gris_th tiulo_th" scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
				<?PHP 
				 //[SP_BUS_FACTURA_SERIE] 0,'',0,0,'','','','','','',1
				$qry = "[SP_BUS_FACTURA_SERIE] ".$txt_id_serie.",'";
				$qry .= $cbo_descripcion_bd."','";
				$qry .= $cbo_id_programa_detalle."','";
				$qry .= $cbo_tipo_impresora."','";
				$qry .= $cbo_sigla_serie."','";
				$qry .= $cbo_codigo_impresoraF."','";
				$qry .= $cbo_cod_vendedor."','";
				$qry .= $txt_cod_ubicacion."','";
				$qry .= $txt_cod_operacion."','";
				$qry .= $txt_codigo_Serie."','";				
				$qry .= "2'";
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
				   <tr align="center" id="tr_data" onClick="javascript:bus_datos('<?PHP echo $rowusu['id_serie'];?>',
				   						             '<?PHP echo $rowusu['descripcion'];?>',
													 '<?PHP echo $rowusu['id_programa_detalle'];?>',
													 '<?PHP echo $rowusu['tipo_impresora'];?>',
													 '<?PHP echo $rowusu['sigla_serie'];?>',
													 '<?PHP echo $rowusu['codigo_impresoraF'];?>',
													 '<?PHP echo $rowusu['cod_vendedor'];?>',													 
													 '<?PHP echo $rowusu['cod_ubicacion'];?>',
													 '<?PHP echo $rowusu['cod_operacion'];?>',
													 '<?PHP echo $rowusu['codigo_Serie'];?>',													 
													 '<?PHP echo $rowusu['status'];?>')">
													 
													 
					  <th 				 class="td_move"><a id="enlace" href="#ir"><?PHP echo $rowusu['id_serie'];?></a></th>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['descripcion'];?></td>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['nombre_detalle'];?></td>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['nombre_impresora'];?></td>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['sigla_serie'];?></td>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['codigo_impresoraF'];?></td>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['cod_vendedor'];?></td>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['cod_ubicacion'];?></td>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['cod_operacion'];?></td>
					  <td align="left" 	 class="td_move"><?PHP echo $rowusu['codigo_Serie'];?></td>
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
		
function bus_datos (id,
					descripcion,
					programa,
					tipo_impresora,
					sigla_serie,
					codigo_impresoraF,
					cod_vendedor,
					cod_ubicacion,
					cod_operacion,
					codigo_Serie,
					status)
{	
	
	$("#txt_id_serie").val(id);
	$("#cbo_descripcion_bd").val(descripcion);
	$("#cbo_id_programa_detalle").val(programa);
	$("#cbo_tipo_impresora").val(tipo_impresora);
	$("#txt_sigla_serie").val(sigla_serie);
	$("#txt_codigo_impresoraF").val(codigo_impresoraF);
	$("#txt_cod_vendedor").val(cod_vendedor);
	$("#txt_cod_ubicacion").val(cod_ubicacion);
	$("#txt_cod_operacion").val(cod_operacion);	
	$("#txt_codigo_Serie").val(codigo_Serie);	
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
	url: "../datos/eli_factura_serie.php",
	data:"txt_id_serie="+valor,				 
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
			$('#contenedor').load('../paginas/issg_factura_serie.php');	  			

			
		}else{
			toastr.error('Error Eliminando los datos en  la tabla < Factura Serie > !!!', "Error !!!", {
			"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
			return false;			
		}
	},	
	error: function(error) {				
		alert("Problemas con la pagina alm_factura_serie ... comuniquese con el Personal de Sistemas !!!" + error);
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
		$('#cbo_descripcion_bd').focus();
		
	//------------------------->
	//PROCESO DE GUARDADO	
	$('#btn_nuevo').on('click', function(){	
		
		desbloquea_caja_nuevo();
		$("#txt_id_serie").val(0);	
		$("#cbo_descripcion_bd").val('');
		$("#cbo_id_programa_detalle").val('');
		$("#cbo_tipo_impresora").val('');
		$("#txt_sigla_serie").val('');
		$("#txt_codigo_impresoraF").val('');
		$("#txt_cod_vendedor").val('');		
		$("#txt_cod_ubicacion").val('');
		$("#txt_cod_operacion").val('');
		$("#txt_codigo_Serie").val('');		
		$("#cbo_status").val('');
	
		$("#cbo_descripcion_bd").focus();		
	});
	
	
	$('#btn_guardar').on('click', function(){	

		//inicio de validaciones		
		var txt_id_serie				= 	$("#txt_id_serie").val();
		var cbo_descripcion_bd			= 	$.trim($("#cbo_descripcion_bd").val());
		var cbo_id_programa_detalle		= 	$.trim($("#cbo_id_programa_detalle").val());
		var cbo_tipo_impresora			= 	$.trim($("#cbo_tipo_impresora").val());		
		var txt_sigla_serie				= 	$.trim($("#txt_sigla_serie").val());
		var txt_codigo_impresoraF		= 	$.trim($("#txt_codigo_impresoraF").val());
		var txt_cod_vendedor			= 	$.trim($("#txt_cod_vendedor").val());		
		var txt_cod_ubicacion			= 	$.trim($("#txt_cod_ubicacion").val());
		var txt_cod_operacion			= 	$.trim($("#txt_cod_operacion").val());
		var txt_codigo_Serie			= 	$.trim($("#txt_codigo_Serie").val());		
		var cbo_status					= 	$.trim($("#cbo_status").val());	
		var txt_codigo_Serie_bd			=   $.trim($("#txt_codigo_Serie_bd").val());
			

		if(txt_id_serie == '')
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
		
		if(cbo_descripcion_bd == '' )
		{
			 bloquea();
			 toastr.error("Error en el Campo -- <b> DESCRIPCIÓN <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#cbo_descripcion_bd").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;	
		}
		
		if(cbo_id_programa_detalle == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b>  PROGRAMA DETALLE <b/> --", "Error !!!", {
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

		if(cbo_tipo_impresora == '')
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b>  TIPO DE IMPRESORA <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#cbo_tipo_impresora").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}
		
		if(cbo_tipo_impresora != 1)
		{
			if(txt_sigla_serie == '' ||  txt_sigla_serie.length < 2)
			{
				 bloquea();
				 toastr.error("Error en en Campo -- <b> SIGLAS SERIE <b/> --", "Error !!!", {
				  "showDuration": "50",
				  "hideDuration": "500",
				  "timeOut": "2000",
				  "extendedTimeOut": "1000",
				  "preventDuplicates": true,
				  "onclick": null,
				  "progressBar": true,
				  "positionClass": "toast-bottom-full-width"
				});	
				$("#txt_sigla_serie").focus();
				setTimeout(function(){ desbloquea();}, 2000);
				return false;				
			}
		}
				

		if(txt_codigo_impresoraF == '' || txt_codigo_impresoraF.length < 1)
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> CODIGO IMPRESORA FISCAL <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_codigo_impresoraF").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;				
		}
		
		
		if (txt_codigo_Serie_bd == 0)
		{
			if(txt_cod_vendedor == '' || txt_cod_vendedor.length < 1 )
			{
				 bloquea();
				 toastr.error("Error en en Campo -- <b> CODIGO VENDEDOR <b/> --", "Error !!!", {
				  "showDuration": "50",
				  "hideDuration": "500",
				  "timeOut": "2000",
				  "extendedTimeOut": "1000",
				  "preventDuplicates": true,
				  "onclick": null,
				  "progressBar": true,
				  "positionClass": "toast-bottom-full-width"
				});	
				$("#txt_cod_vendedor").focus();
				setTimeout(function(){ desbloquea();}, 2000);
				return false;				
			}
		}

		
		if (txt_codigo_Serie_bd == 1)
		{
			if(txt_cod_ubicacion == '' || txt_cod_ubicacion.length < 1 )
			{
				 bloquea();
				 toastr.error("Error en en Campo -- <b> CODIGO UBICACIÓN <b/> --", "Error !!!", {
				  "showDuration": "50",
				  "hideDuration": "500",
				  "timeOut": "2000",
				  "extendedTimeOut": "1000",
				  "preventDuplicates": true,
				  "onclick": null,
				  "progressBar": true,
				  "positionClass": "toast-bottom-full-width"
				});	
				$("#txt_cod_ubicacion").focus();
				setTimeout(function(){ desbloquea();}, 2000);
				return false;				
			}		
		}
		
		
		if (txt_codigo_Serie_bd == 2)
		{
			if(txt_cod_operacion == '' || txt_cod_operacion.length < 1 )
			{
				 bloquea();
				 toastr.error("Error en en Campo -- <b> CODIGO OPERACIÓN <b/> --", "Error !!!", {
				  "showDuration": "50",
				  "hideDuration": "500",
				  "timeOut": "2000",
				  "extendedTimeOut": "1000",
				  "preventDuplicates": true,
				  "onclick": null,
				  "progressBar": true,
				  "positionClass": "toast-bottom-full-width"
				});	
				$("#txt_cod_operacion").focus();
				setTimeout(function(){ desbloquea();}, 2000);
				return false;				
			}		
		}
		
		
		if(txt_codigo_Serie == '' || txt_codigo_Serie.length < 1 )
		{
			 bloquea();
			 toastr.error("Error en en Campo -- <b> CODIGO SERIE <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#txt_codigo_Serie").focus();
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
			url: "../datos/alm_factura_serie.php",
			data:"txt_id_serie="+$("#txt_id_serie").val()+
			 "&cbo_descripcion_bd="+$("#cbo_descripcion_bd").val()+			 
			 "&cbo_id_programa_detalle="+$("#cbo_id_programa_detalle").val()+
			 "&cbo_tipo_impresora="+$("#cbo_tipo_impresora").val()+
			 "&txt_sigla_serie="+$("#txt_sigla_serie").val()+
			 "&txt_codigo_impresoraF="+$("#txt_codigo_impresoraF").val()+
			 "&txt_cod_vendedor="+$("#txt_cod_vendedor").val()+	
			 "&txt_cod_ubicacion="+$("#txt_cod_ubicacion").val()+			 
			 "&txt_cod_operacion="+$("#txt_cod_operacion").val()+			 
			 "&txt_codigo_Serie="+$("#txt_codigo_Serie").val()+			 
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
					$('#contenedor').load('../paginas/issg_factura_serie.php');							
				
				}else if(result == 2){

					bloquea()
					toastr.success('Datos Actualizados con Éxito !!!', "Exito !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
					setTimeout(function(){ desbloquea();}, 5000);

					$("#contenedor").empty();
					$('#contenedor').load('../paginas/issg_factura_serie.php');

				}else{
					toastr.error('Error Insertando los datos en  la tabla < Fatura Serie> !!!', "Error !!!", {
					"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});
					return false;			
				}		
			},			
			error: function(error) {				
				alert("Problemas con la pagina alm_factura_serie ... comuniquese con el Personal de Sistemas !!!" + error);
				}		
			});	
	});		
		
	$('#btn_eliminar').on('click', function(){
		var valor;
		valor = $('#txt_id_serie').val();		
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
	
	$("#cbo_descripcion_bd").change(function(){
		
		var valor_cbo = $("#cbo_descripcion_bd").val();
		var str = valor_cbo
		var n = str.search("-");
		var sub_str = str.substr(n+1,1); 
		
		$("#txt_codigo_Serie_bd").val(sub_str);		
	
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
  	$("#cbo_descripcion_bd").attr("disabled", '0');
	$('#cbo_id_programa_detalle').attr('disabled','0');	
	$("#cbo_tipo_impresora").attr('disabled','0');
	$('#txt_sigla_serie').attr('disabled','0');	
	$('#txt_codigo_impresoraF').attr('disabled','0');	
	$('#txt_cod_vendedor').attr('disabled','0');	
	$('#txt_cod_ubicacion').attr('disabled','0');
	$('#txt_cod_operacion').attr('disabled','0');
	$('#txt_codigo_Serie').attr('disabled','0');		
	$('#cbo_status').attr('disabled','0');	
}

function desbloquea_caja()
{
    $("#cbo_descripcion_bd").attr("disabled", false);	
	$('#cbo_id_programa_detalle').attr('disabled',false);	
	$('#cbo_tipo_impresora').attr('disabled',false);	
	$('#txt_sigla_serie').attr('disabled',false);	
	$('#txt_codigo_impresoraF').attr('disabled',false);	
	$('#txt_cod_vendedor').attr("disabled", false);
	$('#txt_cod_ubicacion').attr("disabled", false);
	$('#txt_cod_operacion').attr("disabled", false);
	$('#txt_codigo_Serie').attr("disabled", false);
	$('#cbo_status').attr('disabled',false);
}

function desbloquea_caja_nuevo()
{
    $("#cbo_descripcion_bd").attr("disabled", false);	
	$('#cbo_id_programa_detalle').attr('disabled',false);	
	$('#cbo_tipo_impresora').attr('disabled',false);	
	$('#txt_sigla_serie').attr('disabled',false);	
	$('#txt_codigo_impresoraF').attr('disabled',false);	
	$('#txt_cod_vendedor').attr("disabled", false);
	$('#txt_cod_ubicacion').attr("disabled", false);
	$('#txt_cod_operacion').attr("disabled", false);
	$('#txt_codigo_Serie').attr("disabled", false);			
	$('#cbo_status').attr('disabled',false);
}

</script>
</body>
</html>