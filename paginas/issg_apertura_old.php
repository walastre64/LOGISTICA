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


// query q busca el periodo que se encuentra activo //
$qry  = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC SP_BUS_PERIODO 0,0,1";
$rst  = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
$rowP = sqlsrv_fetch_array($rst);

$periodo_activo 		= $rowP[1];
$fecha_apertura_activo	= $rowP[2];



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
#id_container6 {
	clear: both;
	background: #ffffff;
	width: 98%;
	overflow: auto;
	padding:15px;
}

.input__row{
  margin-top: 10px;  
}
/* Radio button */
.radiobtn {
  display: none;
}
.buttons {
  margin-left: -40px;
}
.buttons li {
  display: block;
}
.buttons li label{
  padding-left: 30px;
  position: relative;
  left: -25px;
}
.buttons li label:hover {
  cursor: pointer;
}
.buttons li span {
  display: inline-block;
  position: relative;
  top: 5px;
  border: 2px solid #ccc;
  width: 18px;
  height: 18px;
  background: #fff;
}
.radiobtn:checked + span::before{
  content: '';
  border: 2px solid #fff;
  position: absolute;
  width: 14px;
  height: 14px;
  background-color: #c3e3fc;
}
.Estilo1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>

<body>

<!-- ---------------------------------------------------------------------------------------->
<div id="1"> <!-- inicio -->		

	<div id="div_alerta">
	</div>

	<div id="divProceso" class="cCargando" style="visibility: hidden;">
	</div>

	<div style="text-align: center;" id="div_carga">
		<img id="cargador" src="../imagenes/GIF/loading2.gif"/>
	</div>

</div> <!-- fin inicio -->	
<!-- ---------------------------------------------------------------------------------------->
	
<a name="ir">
</a>


<!-- div_totulo ///////////////////////////////////////////////////////////////////////////////////////-->
  <div id="div_totulo" style="background:#EAEAEA; padding:15px;" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<!--<h3 class="h3 text-dark">Base de Datos </h3><span class="fa-twitter fa"></span> -->
		 <h4 id="titulo_pantalla" class="text-light"><strong>Apertura y Cierre de Periodos.</strong></h4>
  </div>	
 <!-- fin div_totulo -->	 	  


<div id="id_container3" class="container-fluid border border-info" style="padding:15px;">

      <table class="table table-sm table-bordered  table-hover" style="font-size:12px">          
            <thead style="background:#3399CC;">
			<tr>
				<th class="contorno_gris_th tiulo_th" scope="col">Perido Aperturado</th>
				<th class="contorno_gris_th tiulo_th" scope="col">Fecha Apertura</th>
			</tr>
          </thead>
			<tbody>
		<th align="center" valign="middle" class="td_move"> <h2 align="center" id="valor_apertura" ><strong><?PHP echo $periodo_activo;?></strong></h2></th>
				<th align="center" class="td_move"> <h2 align="center" id="valor_apertura" ><strong><?PHP echo $fecha_apertura_activo;?></strong></h2></th>
			</tbody>
	  </table>
		<section> 	
			<div id="id_container1" class="container border border-info" style="padding:5px;">			
				<button type="button" id="btn_muestra_cerrar" class="btn btn-info btn-lg btn-block">CERRA PERIODO</button>			
			</div>
		</section> 	

</div>
<!-- fin id_container3 -->    

<div id="id_container6" class="container-fluid border border-info" style="padding:15px;">
  	
	<table width="560" id="tabla_migrar" class="table table-responsive w-100 d-block d-md-table">
    <tr>
	    <td colspan="4"><div align="center"><strong>Migracion de Cuentas </strong></div></td>
    </tr>
    <tr>
      <td><strong>Cuentas:</strong></td>
      <td width="80"><strong>Mantener</strong></td>
      <td><strong>Migrar</strong></td>
      <td width="79" rowspan="4" align="center" valign="middle">        
          <label></label>
          <input name="btn_procesar" type="button" id="btn_procesar" value="PROCESAR">      </td>
    </tr>
    <tr>
    <td width="267">
		  <ul>
			<li>Cuentas contables </li>
	  	  </ul>	</td>
     
	<div class="form-check">		
		<td align="center">
			<div class="custom-control custom-radio">
			  <input type="radio" id="rdb_ctactable1" value="1" name="rdb_ctactable" class="custom-control-input">
			  <label class="custom-control-label" for="rdb_ctactable1"></label>
			</div>		</td>
		
		<td width="114" align="center">
			<div class="custom-control custom-radio">
			  <input type="radio" id="rdb_ctactable2" value="2" name="rdb_ctactable" class="custom-control-input">
			  <select name="cbo_migra_ctactable" disabled="disabled" id="cbo_migra_ctactable">
                <option value="0" selected>-</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
              </select>
			  <label class="custom-control-label" for="rdb_ctactable2"></label>
			</div>		</td>
	</div>
	  </tr>
    
	
	<tr>
      	<td>
			<ul>
				<li>Partidas Presupuestarias </li>
			</ul>		</td>
	  
	<div class="form-check">		
		<td align="center">
			<div class="custom-control custom-radio">
			  <input type="radio" id="rdb_partida_pre3" value="1" name="rdb_partida_pre" class="custom-control-input">
			  <label class="custom-control-label" for="rdb_partida_pre3"></label>
			</div>		</td>
		
		<td align="center">
			<div class="custom-control custom-radio">
			  <input type="radio" id="rdb_partida_pre4" value="2" name="rdb_partida_pre" class="custom-control-input">
			  <select name="cbo_migra_partidapre"  disabled="disabled" id="cbo_migra_partidapre">
                <option value="0" selected>-</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
              </select>
			  <label class="custom-control-label" for="rdb_partida_pre4"></label>
			</div>		
		</td>
	</div>
	</tr>


	<tr>
     <td><ul>
        	<li>Estructura Presupuestarias </li>
      	  </ul>	 </td>
     
	<div class="form-check">		
		<td align="center">
			<div class="custom-control custom-radio">
			  <input type="radio" id="rdb_estructura5" value="1" name="rdb_estructura" class="custom-control-input">
			  <label class="custom-control-label" for="rdb_estructura5"></label>
			</div>		</td>
		
		<td align="center">
			<div class="custom-control custom-radio">
			  <input type="radio" id="rdb_estructura6" value="2" name="rdb_estructura" class="custom-control-input">
			  <label class="custom-control-label" for="rdb_estructura6"></label>
			  <select name="cbo_migra_estructura" disabled="disabled" id="cbo_migra_estructura">
                <option value="0" selected>-</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
              </select>
			</div>		</td>
	</div>
	  </tr>
  </table>
    <br>
    
	<table width="560" id="tabla_resultado" class="table table-responsive w-100 d-block d-md-table">
      <tr>
        <td colspan="4"><div align="center" class="Estilo1"> Resultados </div></td>
      </tr>
      
      <tr>
        <td width="267"><ul>
            <li>Cuentas contables </li>
        </ul></td>
        <div class="form-check">
          <td width="80" align="center" valign="middle"><img src="../imagenes/png/resueltos.png" alt="check" width="25" height="25"></td>
          <td width="114" align="center" valign="middle"></td>
          <td width="79" rowspan="3" align="center" valign="middle"></td>
        </div>
      </tr>
      <tr>
        <td><ul>
            <li>Partidas Presupuestarias </li>
        </ul></td>
        <div class="form-check">
          <td align="center" valign="middle"></td>
          <td align="center" valign="middle"><img src="../imagenes/png/resueltos.png" alt="check" width="25" height="25"></td>
        </div>
      </tr>
      <tr>
        <td><ul>
            <li>Estructura Presupuestarias </li>
        </ul></td>
        <div class="form-check">
          <td align="center" valign="middle"><img  src="../imagenes/png/resueltos.png" alt="check" width="25" height="25"></td>
          <td align="center" valign="middle"></td>
        </div>
      </tr>
    </table>
</div>

<script>
function initControls()
{
	window.location.hash="red";
	window.location.hash="Red"; //chrome
	window.onhashchange=function(){window.location.hash="red";}
}

$(document).ready(function(){  

	var posicion_scroll = $("#1").offset().top;
	$("#id_container6").hide();

	$('#div_carga')
			.hide()
			.ajaxStart(function() {
				$(this).show();
			})
			.ajaxStop(function() {
				$(this).hide();
			});
	
	initControls();	
	
	
/*btn_muestra_cerrar	*/
   $("#btn_muestra_cerrar").on( "click", function() {   
         $('#id_container6').toggle(5000);
   });
  
  $("#btn_procesar").on( "click", function() {     
	
	 var valor_cta_contable
	 var valor_partida_pre
	 var valor_estructura
	
	 valor_cta_contable 	= $('input[name=rdb_ctactable]:checked').val();
	 valor_partida_pre		= $('input[name=rdb_partida_pre]:checked').val();
	 valor_estructura	 	= $('input[name=rdb_estructura]:checked').val();

  });	

//--------------------------------------------------------->
	$("#rdb_ctactable2").on( "click", function() {			
		$("#cbo_migra_ctactable").attr("disabled", false); 
	});		
	$("#rdb_ctactable1").on( "click", function() {			
		$("#cbo_migra_ctactable").val(0);
		$("#cbo_migra_ctactable").attr("disabled", true); 
	});	
//--------------------------------------------------------->

	$("#rdb_partida_pre4").on( "click", function() {			
		$("#cbo_migra_partidapre").attr("disabled", false); 
	});	
	$("#rdb_partida_pre3").on( "click", function() {
		$("#cbo_migra_partidapre").val(0);
		$("#cbo_migra_partidapre").attr("disabled", true); 
	});	
//---------------------------------------------------------->	
	
	$("#rdb_estructura6").on( "click", function() {			
		$("#cbo_migra_estructura").attr("disabled", false); 
	});	
	$("#rdb_estructura5").on( "click", function() {
		$("#cbo_migra_estructura").val(0);
		$("#cbo_migra_estructura").attr("disabled", true); 
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
</script>
</body>
</html>