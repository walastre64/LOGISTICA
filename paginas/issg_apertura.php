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

.progress {
    display: block;
    text-align: center;
    width: 0;
    height: 30px;
    background: red;
    transition: width .3s;
}
.progress.hide {
    opacity: 0;
    transition: opacity 1.3s;
}
.ui-progressbar-value {
    font-size: 13px;
    font-weight: normal;
    line-height: 18px;
    padding-left: 10px;
}

-->
</style>
</head>

<body>
<!-- ---------------------------------------------------------------------------------------->
<div id="1"> <!-- inicio -->		

	<div id="div_alerta"></div>

	<div id="divProceso" class="cCargando" style="visibility: hidden;">
	</div>

	<div style="text-align: center;" id="div_carga">
		<img id="cargador" src="../imagenes/GIF/loading2.gif"/>
	</div>


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
				<button type="button" id="btn_muestra_cerrar" class="btn btn-info btn-lg btn-block">CERRAR PERIODO</button>			
			</div>
		</section> 	

</div>
<!-- fin id_container3 -->    

<div id="id_container6" class="container-fluid border border-info" style="padding:15px;">
  
  <table width="667"  align="center" bordercolor="#999999" class="table table-responsive w-100 d-block d-md-table" id="tabla_migrar">
      <tr>
        <td width="33%"><strong>Cuentas:</strong></td>
        <td width="12%"><div align="left"><strong>Mantener</strong></div></td>
        <td width="55%"><div align="left"><strong>Migrar</strong></div></td>
      </tr>
      <tr>
        <td><ul>
          <li>Cuentas contables </li>
        </ul>
          <ul>
            <li>Partidas Presupuestarias </li>
          </ul>
          <ul>
            <li>Estructura Presupuestarias </li>
        </ul></td>
        <td width="12%">
		  <div class="custom-control custom-radio">        
				<input type="radio" id="radio" value="1" name="rdb_accion" class="custom-control-input">        
			  <label class="custom-control-label" for="radio"></label>
		  </div>
		</td>
        <td width="55%">
		  <div class="custom-control custom-radio">        
				<input type="radio" id="radio2" value="2" name="rdb_accion" class="custom-control-input">
				<select name="cbo_anomigra" disabled="disabled" id="cbo_anomigra">
				  <option value="0" selected>-</option>
					<?PHP
					$qry  = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC SP_BUS_PERIODO 0,0,0";
					$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
					if (! $rst) {  
					   echo "Error en la ejecución de la instrucción ".$qry.".\n";
					   die( print_r2( sqlsrv_errors(), true));  
					   exit;
					}
						while( $rowp = sqlsrv_fetch_array($rst)) { ?>
						<option value="<?PHP echo $rowp[0];?>"><?PHP echo $rowp[1];?></option>
					<?PHP }?>


			</select>
			  <label class="custom-control-label" for="radio2"></label>
		  </div>
		</td>
      </tr>
      
      <tr>
        <td colspan="3" align="center" valign="middle"><div align="center"><button id="btn_procesar" style="margin-top:50px" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-k btn-danger">PROCESAR !!!</button></div></td>
      </tr>
    </table>
</div>
<!-- fina id_container6 -->
    
<div id="id_container7" class="container-fluid border border-info" style="padding:15px;"></div> 
<!-- fin <div id_container7 -->

</div> <!-- fin inicio -->

	
<script>
function initControls()
{
	window.location.hash="red";
	window.location.hash="Red"; //chrome
	window.onhashchange=function(){window.location.hash="red";}
}

$(document).ready(function(){  


$("#btn_muestra_cerrar").click(function () {           

	var clase = $('#btn_muestra_cerrar').attr('class');
	
	if (clase.includes("btn-info")) {                        
		$('#btn_muestra_cerrar').removeClass('btn-info');
		$('#btn_muestra_cerrar').addClass('btn-danger');
	} else {
		$('#btn_muestra_cerrar').removeClass('btn-danger');
		$('#btn_muestra_cerrar').addClass('btn-info');
	}           
});

	
	var posicion_scroll = $("#1").offset().top;
	$("#id_container6").hide();
	$("#id_container7").hide();	
	

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
         $('#id_container6').toggle(2000);
		 $("#rdb_accion").focus();		
   });
  
    $("input[name=rdb_accion]").click(function () {
		var valor_accion
		valor_accion = $('input:radio[name=rdb_accion]:checked').val();
		
		if(valor_accion == 2){
			$("#cbo_anomigra").attr("disabled", false); 
		}else{
			$("#cbo_anomigra").val(0);
			$("#cbo_anomigra").attr("disabled", true);			
		}
		
	});
	//rdb_accion
	
	
	$("#btn_procesar").on( "click", function() {

		/* validacion de cuantas a migrar */
		valor_rdb = $('input:radio[name=rdb_accion]:checked').val();
		 if(!$('input[name="rdb_accion"]').is(':checked')) {

			 bloquea();
			 toastr.error("Debe selecionar una Opcion para las Cuentas ...", "Error !!!", {
			  "showDuration": "50",
			  "hideDuration": "500",
			  "timeOut": "2000",
			  "extendedTimeOut": "1000",
			  "preventDuplicates": true,
			  "onclick": null,
			  "progressBar": true,
			  "positionClass": "toast-bottom-full-width"
        	});	
			$("#rdb_accion").focus();
			setTimeout(function(){ desbloquea();}, 2000);
			return false;		 	
		 }

		 if (valor_rdb == 2){
		 	var cbo_anomigra
			cbo_anomigra = $("#cbo_anomigra").val();
			if(cbo_anomigra == 0)
			{				 
		 	
				 bloquea();
				 toastr.error("Debe selecionar un AÑO para las  MIGRACION de las Cuentas ...", "Error !!!", {
				  "showDuration": "50",
				  "hideDuration": "500",
				  "timeOut": "2000",
				  "extendedTimeOut": "1000",
				  "preventDuplicates": true,
				  "onclick": null,
				  "progressBar": true,
				  "positionClass": "toast-bottom-full-width"
				});	
				$("#cbo_anomigra").focus();
				setTimeout(function(){ desbloquea();}, 2000);
				return false;		 	
		 	}
		 }		 

		/* FIN de cuantas a migrar */		

		var valor
		valor = 999992; /*valor para ventana el tipo de ventana modal*/
	
		$("#div_alerta").prepend(ventana_modal_2(valor,'APERTURAR PERIODO CONTABLE','Desea realmente realizar este proceso !!! <br>  <span class="blinking"> *- Proceso delicado que solo debe ejecutarse estando seguro del mismo </span>','APERTURAR PERIODO CONTABLE',3));			
	
			$('#btn_modal_aceptar').on('click', function(){
				alert('aceptar')
			});
			
			
			$('#btn_modal_cancelar').on('click', function(){
				/* limpiar pagina */
				
			
			});
	});


//////////////////////>>>>>>>>>>>>>>>>>>>>>>
$( "#progressbar" ).progressbar({
  value: 0,
  max: 100
}).children('.ui-progressbar-value');

var data = [];
//Datos para simular servidor
for (var i = 0; i < 50000; i++) {
    var tmp = [];
    for (var i = 0; i < 50000; i++) {
        tmp[i] = 'datos';
    }
    data[i] = tmp;
};
$.ajax({
    xhr: function () {
    		//Creamos el xhr
        var xhr = new window.XMLHttpRequest();
        //Añadimos el evento upload
        xhr.upload.addEventListener("progress", function (evt) {        		
            if (evt.lengthComputable) {
            		//El porcentaje completado será lo subido entre el total 
                var percentComplete = evt.loaded / evt.total;
                console.log(percentComplete);
                //Actualizamos la barra de JQuery-UI
                $( "#progressbar" ).progressbar("value",percentComplete*100);
                $(".ui-progressbar-value").html(Math.round(percentComplete*100) + '%');
                //Actualizamos el div
                $('.progress').css({
                    width: percentComplete * 100 + '%'
                });
                if (percentComplete === 1) {
                    $('.progress').addClass('hide');
                }
            }
        }, false);
        xhr.addEventListener("progress", function (evt) {
            if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                console.log(percentComplete);
                $( "#progressbar" ).progressbar("value",percentComplete*100);
                $(".ui-progressbar-value").html(Math.round(percentComplete*100) + '%');
                $('.progress').css({
                    width: percentComplete * 100 + '%'
                });
                
            }
        }, false);
        return xhr;
    },
    type: 'POST',
    url: "/echo/html",
    data:data,
    success: function (response) {
    console.log(response);
    }
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