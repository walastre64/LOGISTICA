<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE'); # Localiza en espa�ol es_Venezuela
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
// ------------------------------------------------->
//session_valida();
$conn = conectate();
session_start();

function salida()
{
	header("location: ../index.php");
}

$usuario 	= $_SESSION['nombre'];
$rol 	 	= $_SESSION['rol'];
$id_usuario	= $_SESSION['id_usuario'];

$fecha = '';
$fecha = date("d/m/Y"); 

if($rol == 9)
{
	$id_usuario = 0;
}


$fecha_logistica = date("d/m/Y");
if(isset($_POST['fecha_logistica'])){
	$fecha_logistica = $_POST['fecha_logistica'];}

$valor_elimina = '';
if(isset($_POST['valor_elimina'])){
	$valor_elimina = $_POST['valor_elimina'];}
	
	
$cbo_gerencia = '';
if(isset($_POST['cbo_gerencia'])){
	$cbo_gerencia = $_POST['cbo_gerencia'];}

	
$cbo_horario	 = '';
if(isset($_POST['cbo_horario'])){
	$cbo_horario = $_POST['cbo_horario'];}


$txt_cantidad	 = '';
if(isset($_POST['txt_cantidad'])){
	$txt_cantidad = $_POST['txt_cantidad'];}

$fecha_logistica = $fecha;
if(isset($_POST['fecha_logistica'])){
	$fecha_logistica = $_POST['fecha_logistica'];}

$Tam 	= 0;
$Tpm 	= 0;
$Tama 	= 0;



// conteo de logistica por horario segun el usuario y la fecha

$qryt = 'SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [dbo].[SP_BUS_TOTALESX] '.$id_usuario.",'".$fecha_logistica."'";

$rst = sqlsrv_query( $conn, $qryt, array(), array("Scrollable"=>"buffered"));
if (! $rst) {  
   echo "Error en la ejecución de la instrucción ".$qryt.".\n";
   die( print_r2( sqlsrv_errors(), true));  
   exit;
}

$Total = 0;
while( $rowt = sqlsrv_fetch_array($rst)) {


	if($rowt[4] == 'AM')
		$Tam  = $Tam + $rowt[2];
	if($rowt[4] == 'PM')
		$Tpm  = $Tpm +  $rowt[2];
	if($rowt[4] == 'AMANECER')	
		$Tama  = $Tama + $rowt[2];
	
	$Total = $Total + $rowt[2]; 	
	
}
?>
<!DOCTYPE html>
<html lang="en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style type="text/css">
    #datepicker {	  height:30px;
	  width:100px;
}
#datepicker {	  height:30px;
	  width:100px;
}
#datepicker {
	height: 30px;
	width: 100px;
	text-align: left;
}
#datepicker2 {	  height:30px;
	  width:100px;
}
#datepicker2 {	  height:30px;
	  width:100px;
}
#datepicker2 {	  height:30px;
	  width:100px;
}

.flexbox {
  align-items: center;
  display: flex;
  height: 150px;
  justify-content: center;
  width: 300px;

  background: #ffff99;
  color: #333;
}




</style>
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	    <meta http-equiv="Expires" content="0" />
    	<meta http-equiv="Pragma"  content="no-cache" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
	    <link rel="stylesheet" href="../config_boostrap/bootstrap.min.css">
    	<script src="../config_jquery/jquery.min.js"></script>
	    <script src="../config_popper/popper.min.js"></script>
    	<script src="../config_boostrap/bootstrap.min.js"></script>  

    	    
		
   	<link rel="stylesheet" type="text/css" href="../css/login.css">
	    <link rel="shortcut icon" href="../imagenes/favicon.ico" type="image/x-ico"/>
    



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


        <title>LOGISTICA</title>
        

        <link href="../config_datatable/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="../config_datatable/all.js" crossorigin="anonymous"></script>
		<script src="../validacion/validacion_general.js"></script>


		<link rel="stylesheet" href="../bootstrap/dist/awesome/css/font-awesome.min.css" 	crossorigin="anonymous">
		<link rel="stylesheet" href="../bootstrap/dist/toastr/toastr.min.css"  			crossorigin="anonymous">



<style type="text/css">
<!--

body {
    /*background-color: #173F92 !important;*/
	background: rgb(24,66,142);
	background: linear-gradient(90deg, rgba(24,66,142,1) 22%, rgba(252,194,68,1) 100%, rgba(2,0,36,1) 100%);
    border: 0 !important;
}


.datepicker, .datepicker2{
	
	font-size: 0.875em;	

}
/* solution 2: the original datepicker use 20px so replace with the following:*/

.datepicker td, .datepicker th, .datepicker2 td, .datepicker2 th  {
	width:  1 em;
	height: 1 em;
	
	
}


/*Escritorio*/
@media (min-width: 1199.98px)  {
    /*body{background: red;}*/
}
/*Fin Escritorio*/




/*320px — 480px: dispositivos móviles
481px — 768px: iPads, tabletas
769px — 1024px: pantallas pequeñas, portátiles
1025px — 1200px: Computadoras de escritorio, pantallas grandes
1201px y más —  Pantallas extra grandes, TV*/

/*Tablet*/
/*Portrait*/
@media (min-width: 576px) and (max-width: 991.98px) and (orientation:portrait) {
    body{background: orange;}
}

/*landscape*/
@media (min0-width: 991.98px) and (max-width: 1199.98px)and (orientation:landscape) {
    body{background: blue;}
}
/*fin tablet*/


 
@media (max-width: 320px)and (orientation:portrait) {
   
 }

/*landscape
@media (min-width: 576px) and (max-width: 991.98px) and (orientation:landscape) {
    body{background: black;}
}
*/




#arriba {
	
	padding-top:5px;
	padding-left:10px;
	padding-right:10px;	
	display: inline-block; 
}

#botonera {
	
	padding-left:3px;
	padding-right:3px;	

}


#cbo_gerencia{
  display:block;
  height:30px;
  width:250px;
}

#cbo_horario{
  display:block;
  height:30px;
  width:250px;
}

#cbo_reporte{
  display:block;
  height:30px;
  width:250px;
}

#txt_cantidad{
  display:block;
  height:30px;
  width:70px;
}

#botonera > * {
  margin-bottom: 10px;
}

#botonera2 > * {
  margin-bottom: 10px;
}

#dv1 {
	/*border-style:solid;
	border-width: 1px;*/
	
}

#dv2 {
	/*border-style:solid;
	border-width: 1px;*/	
}

#dv3 {
	/*border-style:solid;
	border-width: 1px;*/
}


 /* Ejecuta el CSS en pantallas cuyo ancho tenga como mínimo 768px */
/* Es decir, lo ejecuta a partir de 768px en adelante */
@media screen and (width => 320px)  and (width <= 480px){ 

	/*body{background: red;}*/
	#cbo_gerencia{
	  
	  display:block;
	  height:30px;
	  width:125px;
	}

	#cbo_horario{
	  display:block;
	  height:30px;
	  width:150px;
	}


}

/*movil*/
/*Portrait*/
/*Default*/
/*CELULAR*/

@media (max-width: 412 px)and (orientation:portrait) {
	
}

@media (max-width: 575.98px)and (orientation:portrait) {
	
	/*body{background: blue;}*/
	#cbo_gerencia{
	  display:block;
	  height:30px;
	  width:125px;
	}

	#cbo_horario{
	  display:block;
	  height:30px;
	  width:150px;
	}	
	
	#cbo_reporte{
	  display:block;
	  height:35px;
	  width:110px;
	}		

	#datepicker, #datepicker2 {
	  height:30px;
	  width:100px;
	}

		
		
   
 } 
.fecha {
	font-weight: bold;
	color: #FFF;
	text-align: right;
}
.usuario {
	color: #000;
	font-weight: bold;
}


#btn_grabar,#btn_modificar,#btn_eliminar{
  height: 25%;
  width: 25%;

  cursor: pointer;
}


.blinking{
    animation:blinkingText 1.2s infinite;
	 /*background-color:red;*/
}
@keyframes blinkingText{
    0%{     color: #000;    }
    49%{    color: #000; }
    60%{    color: transparent; }
    99%{    color:transparent;  }
    100%{   color: #000;    }
}


</style>
</head>

<body>
<div id="div_alerta"></div>

<!-- Modal -->
<div class="modal fade" id="div_eliminar" tabindex="-1" role="dialog" aria-labelledby="Eliminar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Desea realmente Eliminar este registro ? </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">       
			<?PHP echo $cbo_gerencia; ?>  
            
                 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="btn_aceptar_elimina" type="button" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<div class="card mb-1">
    <div class="card-header">
        <i class="fa fa-bars me-1"></i>
        Menu ¬  
    </div>
    <div class="card-header">
		<i class="fas fa-user  me-1"></i><?PHP  echo $_SESSION['nombre'];?> 
        <i class="fas me-18 align-items-right"></i> <a id="a_desconectar" class="" href="../index.php">Salir</a>
    </div>
</div> 

<div id="arriba" class="toast-bottom-full-width"  style="display: flex; flex-direction: column;">

<div id="dv1" style="display: flex;">  
  <div style="display: flex; flex-direction: column; " >
  
    <div class="form-outline">
        
<div class="table-responsive">      
	  <table  width="262" border="0" cellspacing="5" cellpadding="1">
	    <tr>
	      <td width="645" colspan="4"><select id="cbo_gerencia" class="form-control form-select form-select-sm mb-3" aria-label="Selecione la Gerencia">
	        <option value="0" selected>- Gerencia -</option>
	        <?PHP 
        $qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [dbo].[SP_BUS_GERENCIAXUSUARIO] $id_usuario";
        $rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
        if (! $rst) {  
           echo "Error en la ejecución de la instrucción ".$qry.".\n";
           die( print_r2( sqlsrv_errors(), true));  
           exit;
        }
            while( $rowg = sqlsrv_fetch_array($rst)) { ?>
	        <option value="<?PHP echo $rowg[0];?>"><?PHP echo $rowg[1];?></option>
	        <?PHP }?>
          </select></td>
        </tr>
	    <tr>
	      <td colspan="4">    <select id="cbo_horario" class="form-control form-select form-select-sm mb-3" aria-label="Selecione el horario">
      <option value="0" selected>- Horario -</option>
      <option value="200">AM</option>
      <option value="201">PM</option>
      <option value="202">AMANECER</option>
    </select></td>
        </tr>
      </table>
      
      <input name="id_valor" type="hidden" id="id_valor" value="0" size="2" maxlength="2" />
      <input name="fecha_logistica" type="hidden" id="fecha_logistica" value="<?PHP echo $fecha_logistica;?>"/>
      
      <table width="176" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td><label style="font-size:10px; color:#FFF;"  class="form-label" for="txt_cantidad"><strong>Personas</strong></label>
<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onKeyPress="return solonumeros(event)" step="1" min="1" max="20" maxlength="2" type="number" id="txt_cantidad" class="form-control" />
</td>
    <td style="padding-left:15px; padding-right: 15px;">   
   	 <?PHP if($rol == 9) {?>
	 	<button id="btn_activa" class="btn btn-warning" style="width:95%" >- On -</button> 
	 <?PHP }?>
      </td>
  </tr>
</table>
      



<div style=" width: 95%; padding-top:20px; justify-content: center; ">
	<button id="btn_grabar" class="btn btn-primary" 	style="display: inline-block; margin-right: 5px; height: 20%; width: 45%; margin-bottom: 10px; ">Grabar</button>  
	
    <!--<button id="btn_eliminar" class="btn btn-danger" data-toggle="modal"  data-target="#div_eliminar"	style="display: inline-block; height: 10%;  width: 35%;  margin-bottom: 10px;">Eliminar</button>  -->
    

</div>

    </div>         
</div>           
 </div> 
 
 
<?PHP if($rol == 9) {?>
    <div id="dv2" style="flex: 1;">
     <div style="display: flex; flex-direction: column; " >
       <div id="botonera" class="contenedor" style="display: flex; flex-direction: column;">


<select id="cbo_reporte" style="flex: 1;" class="form-control form-select form-select-sm mb-3" aria-label="Selecione el horario">
                <option value="0" selected>- Reportes -</option>
                <option value="1">Diario</option>
                <option value="2">Mensual</option>
                <option value="3">Gerencia</option>
         </select>
<label style="font-size:10px; color:#333; "  class="form-label" for="datepicker"><span class="fecha">Fecha Inicio</span></label>
<input  data-date-format="dd/mm/yyyy" id="datepicker" />

<label style="font-size:10px; color:#333; "  class="form-label" for="datepicker2"><span class="fecha">Fecha Fin </span></label></td>
    <td><input  data-date-format="dd/mm/yyyy" id="datepicker2" />



       </div>                     
       	
     </div>
    <button id="btn_buscar" class="btn btn-success">Buscar</button>  
    </div>
    
 <?PHP }?>           
    
</div>

  
<div id="abajo">
  
	<div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
        <p style="font-size:14px;">- LOGISTICA CARGADA - | <strong>AM -> <?PHP echo $Tam;?> </strong><strong> | PM -> <?PHP echo $Tpm;?> | </strong> <strong>AMANECER -> <?PHP echo $Tama;?> </strong>
        | - <?PHP echo $fecha_logistica?> - <strong>TOTAL -> <?PHP echo $Total?>  </strong></p></div>
  
  <div class="card-body" style="background-color:#f7f7f7">
  
  
  
  
    <table  id="datatablesSimple" class="display compact table" style="width:100%">
    
      <thead>
        <tr>
          <th>Gerencia</th>
          <th>Cantidad</th>
          <th>Horario</th>
          <th>Fecha</th>
          <th>Mod.</th>
          <th>Eli.</th>
          
        </tr>
      </thead>

		<?PHP 
        
		$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [dbo].[SP_BUS_LOGISTICAXUSUFECHA] $id_usuario, '$fecha'";
		//echo $qry;
        $rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
        if (! $rst) {  
           echo "Error en la ejecución de la instrucción ".$qry.".\n";
           die( print_r2( sqlsrv_errors(), true));  
           exit;
        }?>
		<tbody>
          <?PHP while( $rowlg = sqlsrv_fetch_array($rst)) { ?>             
                <tr>                  
                  <td><?PHP echo $rowlg['gerencia'];?></td>
                  <td><?PHP echo $rowlg['cantidad'];?> </td>
                  <td><?PHP echo $rowlg['horario'];?>  </td>
                  <td><?PHP echo $rowlg['fecha']; ?>   </td>
<td><i onClick="javascript:buscar_elemento(<?PHP echo $rowlg['id_gerencia'];?>,<?PHP echo $rowlg['id_horario'];?>,<?PHP echo $rowlg['cantidad'];?>,'<?PHP echo $rowlg['fecha'];?>')" class="fa fa-pencil m-2"></i></td>
<td><i class="fa  fa-trash m-2" onClick="javascript:elimina_elemento(<?PHP echo $rowlg['id_gerencia'];?>,<?PHP echo $rowlg['id_horario'];?>,<?PHP echo $rowlg['cantidad'];?>,'<?PHP echo $rowlg['fecha'];?>')"></i></td>                                    
                </tr>             
         <?PHP }?>
        </tbody>
    </table>


  </div>
  </div>
</div>
<!-- </div> -->
<script src="../config_datatable/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../js/scripts.js"></script>
<script src="../config_datatable/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="../js/datatables-simple-demo.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script><script type="text/javascript">
    $('#datepicker').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker').datepicker("setDate", new Date());
	
    $('#datepicker2').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker2').datepicker("setDate", new Date());	
</script>


<script type="text/javascript">
function elimina_elemento(gerencia,horario,cantidad,fecha)
{
	
	alert(gerencia +' ' + horario +' ' + cantidad +' ' +fecha); 	

	abreventana_modal(gerencia,horario,cantidad,fecha);
	
	//[SP_ELI_LOGISTICAXHORARIOG]
	
}


function buscar_elemento(id,horario,cantidad,fecha)
{
	$('#cbo_gerencia').val(id);
	$('#cbo_horario').val(horario);
	$('#txt_cantidad').val(cantidad);
	$('#fecha_logistica').val(fecha);	
}

//bus_datos();
function abreventana_modal(gerencia,horario,cantidad,fecha){

	$('#cbo_gerencia').val(gerencia);
	 var val_gernecia = $('#cbo_gerencia').find('option:selected').text(); 

	$('#cbo_horario').val(horario);
	 var val_horario = $('#cbo_horario').find('option:selected').text(); 




bootbox.confirm({
		title: 'Mensaje de Advertencia !!!'  ,
		centerVertical: true,
		size: 'large',
		message: 'Desaa Realmente Eliminar esta Logistica para ?? <strong>' +  val_gernecia + '</strong> Cantidad -> <strong>' + cantidad + ' </strong> Fecha -> <strong>' + fecha + ' </strong>' ,
		buttons: {
		cancel: {
		label: '<i class="fa fa-times"></i> Cancel'
		},
		confirm: {
		label: '<i class="fa fa-check"></i> Confirm'
		}
		},
		callback: function (result) {
		
				// Confirm
				if(result){

						$.ajax({
						type: "POST",
						dataType:"html",
						url: "../datos/eli_logistica.php",
						data:"gerencia="+gerencia+
							 "&horario="+horario+
							 "&cantidad="+cantidad+							 
							 "&fecha="+fecha,
							 
					cache: false,			
					success: function(result) {						
					alert(result);			
					
						if(result == 1){
							toastr.success('Datos Eliminados con Éxito !!!', "Exito !!!", {
							"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
							// redircionar a si mismo					
							setTimeout(function(){ location.href='principal.php';}, 2000);
							//return result;
						
						}else{
							toastr.error('Error Eliminados los datos en  la tabla < [M_LOGISTICA] > !!!', "Error !!!", {
							"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});	
							return false;			
						}		
					},			
					error: function(error) {				
						alert("Problemas con la pagina [SP_ELI_LOGISTICAXHORARIOG] ... comuniquese con el Personal de Sistemas !!!" + error);
						}		
					});
					

				}
		}
	});
	
}


	
$(document).ready(function() {	

const tabla  = document.getElementById("datatablesSimple");
const tabla1 = document.getElementById("tabla1");


	function eliminar(){
		$("#btn_eliminar").click();
	}

	
	$("#btn_eliminar").click(function(){

		var cbo_gerencia = $.trim($("#cbo_gerencia").val());
		var cbo_horario  = $.trim($("#cbo_horario").val());
		var txt_cantidad = $.trim($("#txt_cantidad").val());
		
		// ventana modal por borrado //		
	});

	$("#btn_grabar").click(function(){
		
		var cbo_gerencia 	= $.trim($("#cbo_gerencia").val());
		var cbo_horario  	= $.trim($("#cbo_horario").val());
		var txt_cantidad 	= $.trim($("#txt_cantidad").val());
		var fecha_logistica = $("#fecha_logistica").val();
		
		
		if(cbo_gerencia == 0)
		{
			 toastr.error("Error en en Campo -- <b> Gerencia <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-top-full-width"
        	});	
			$("#cbo_gerencia").focus();			
			return false;
		}		

				
		if(cbo_horario == 0)
		{
			 toastr.error("Error en en Campo -- <b> Horario <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-top-full-width"
        	});	
			$("#cbo_horario").focus();			
			return false;
		}		

		if(txt_cantidad == 0 || txt_cantidad == '')
		{
			 toastr.error("Error en en Campo -- <b> Cantidad <b/> --", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-top-full-width"
        	});	
			$("#txt_cantidad").focus();			
			return false;
		}
		// fin validacion
			//alert(fecha_logistica)

			$.ajax({
			type: "POST",
			dataType:"html",
			url: "../datos/alm_logistica.php",
			data:"cbo_gerencia="+$("#cbo_gerencia").val()+
				 "&cbo_horario="+$("#cbo_horario").val()+
				 "&txt_cantidad="+$("#txt_cantidad").val()+
				 "&fecha_logistica="+fecha_logistica,
		cache: false,			
		success: function(result) {	
		resultado=result.split("/");
		//alert(result);			
		
			if(resultado[0] == 0){
				toastr.success('Datos Almacenados con Éxito !!!', "Exito !!!", {
				"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});				
				// redircionar a si mismo					
				setTimeout(function(){ location.href='prueba_tabla.php';}, 1000);
				//return result;
			
			}else{
				toastr.error('Error Actualizando los datos en  la tabla < [M_LOGISTICA] > !!!', "Error !!!", {
				"showDuration": "50","hideDuration": "500","timeOut": "2000","extendedTimeOut": "1000","preventDuplicates": true,"onclick": null,"progressBar": true,"positionClass": "toast-bottom-full-width"});	
				return false;			
			}		
		},			
		error: function(error) {				
			alert("Problemas con la pagina SP_ALM_LOGISTICAXH ... comuniquese con el Personal de Sistemas !!!" + error);
			}		
		});	
    
    });/* fin $('#btn_guardar') */
	

(function($) {
  $.fn.replaceClass = function(classes) {
    var allClasses = classes.split(/\s+/).slice(0, 2);
    return this.each(function() {
      $(this).toggleClass(allClasses.join(' '));
    });
  };
})(jQuery);
	
	
	$("#btn_activa").click(function(){
		
		var id_valor = document.getElementById('id_valor').value;
		
	 var clase = $('#btn_activa').attr('class');
	  if (clase.includes("btn-warning")) {
		$('#btn_activa').removeClass('btn-warning');
		$('#btn_activa').addClass('btn-secondary');
	  } else {
		$('#btn_activa').removeClass('btn-secondary');
		$('#btn_activa').addClass('btn-warning');
	  }

	var activa = document.getElementById('btn_activa');


		//alert(element);
				
		if(id_valor == 0)
		{
			document.getElementById('id_valor').value = 1			
		  if (activa.innerHTML == '- Off -') 
			  activa.innerHTML = '- On -';
		  else activa.innerHTML = '- Off -'; 
		  
		  // ejecuta qry desactiva
			
	
		}
		
		if(id_valor == 1)
		{
			document.getElementById('id_valor').value = 0;	
		  if (activa.innerHTML == '- Off -') 
			  activa.innerHTML = '- On -';
		  else activa.innerHTML = '- Off -';  

		 // ejecuta qry Activa

			
		}

			
			
	});		
});	<!-- fin ready -->
</script>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script type='text/javascript' src="../validacion/validacion_general.js"></script>   	
<script type='text/javascript' src="../bootstrap/dist/toastr/toastr.min.js"></script>   
<script src="../jquery/popper.min.js" crossorigin="anonymous"></script>
<script src="../bootstrap/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

<!-- bootbox code -->
<script src="../bootbox/bootbox.all.min.js"></script> 

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->	 
</body>
</html>
