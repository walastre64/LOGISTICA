<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE'); # Localiza en espa�ol es_Venezuela
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
include('../restringir/restringir.ini.php');
// ------------------------------------------------->
session_valida();
$conn = conectate();
//session_start();


$nombre = $_SESSION['nombre'];

$nombrep = 'NATACHA GRANADO'; 
$cargop  = 'ANALISTA PROCURA'; 
					


$qry = "select convert(varchar(10),getdate(),103) as fecha,convert(varchar(10),getdate(),108) as hora,day(getdate()) as dia,month(getdate()) as mes,year(GETDATE()) as ano";
$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
if (! $rst) {  
   echo "Error en la ejecución de la instrucción ".$qry.".\n";
   die( print_r2( sqlsrv_errors(), true));  
   exit;
}
$tiempo = sqlsrv_fetch_array( $rst, SQLSRV_FETCH_ASSOC);

function nombremes($mes){
 setlocale(LC_TIME, 'spanish');  
 $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
 return $nombre;
}

$ano			= $tiempo['ano'];
$dia			= $tiempo['dia'];
$nombre_mes		= nombremes($tiempo['mes']);
$mesactual		= $tiempo['mes'];
$fecha			= $tiempo['fecha'];
$hora			= $tiempo['hora'];





// recibir por el get los valores de las ordenes y el relleno
//SP_BUS_SOLICITUD_X_CODIGOSP 126



$solicitud = 0;
if(isset($_GET['solicitud'])){
	$solicitud = $_GET['solicitud'];}

$tipo = '';
if(isset($_GET['tipo'])){
	$tipo = $_GET['tipo'];}



$solicitud = 109;


$qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [SP_BUS_SOLICITUD_X_CODIGOSP_PENDIENTE] ".$solicitud;
$rst 	= sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
$rst2 	= sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
//echo $qry;
if (! $rst) {  
   echo "Error en la ejecución de la instrucción ".$qry.".\n";
   die( print_r2( sqlsrv_errors(), true));  
   exit;
}
$rows2 = sqlsrv_fetch_array($rst2);
//$entregado = $rows2[];	


$fecha_crea = '';
if(isset($_POST['fecha_crea'])){
	$fecha_crea = $_POST['fecha_crea'];}


$recibido  		 = $rows2['NOMBRE_SOLICITA'];	
$cargo_recibido  = $rows2['CARGO_SOLICITA'];	
$areasolicitante = $rows2['area_solicita'];	


$fecha_crea = ($rows2['fecha_crea']);
$fechaObjeto = new DateTime($fecha_crea);
// Formatear la fecha como "31-Dec-1969"
$fechaFormateada = $fechaObjeto->format('d/m/Y');
// Imprimir la fecha formateada
$fecha_crea = $fechaFormateada;

?>

<!DOCTYPE html>
<html lang="es">
<head>
<title>Notas de Entrega</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no, user-scalable=no">
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Pragma"  content="no-cache" />

    <link rel='shortcut icon' type='image/x-icon' href='../paginas/imagenes/ICO/favicon.ico' />
	<link rel="stylesheet"  href="../paginas/css/style_login.css"/> 

<style type="text/css"> 
	.rejilla {	
		font-size:24px;	
		font-family:Arial,Helvetica,sans-serif
		} 
	.rejilla_titulo {	
		font-size: 12px;	
		font-weight: bold;} 
	.Estilo1 {
			font-size: 14px
			} 
	.Estilo2 {
			font-size: 16px
			}



.flex-container > div {
 
  margin: 10px;
  padding:5px;
  border: 1px solid black;
}
.contenedor_new {
	display: flex;  	
	width: 100%;
}			
			
</style>
</head>
<body style="padding-top:10px;">


<div style="background-color:#FFF; padding-top:15px; padding-bottom:15px;" id="contenedor_new" class="container border border-info">
  <table width="40%"   align="center" border="1" cellspacing="0" cellpadding="0">
    <tr>
    <td>

        <table  class="rejilla_titulo" width="650" border="0" align="center" cellpadding="0">
          <tr>
            <th align="center" width="220" height="113" rowspan="3" bgcolor="#FFFFFF"  scope="col"><img src="../imagenes/JPG/bahia.jpg" width="220" height="81" /></th>
            <th style="padding-left:3px" width="282" rowspan="2"  scope="col"><span class="Estilo2">SOLICITUD DE  
            PROCURA <br>
            </span></th>
            <th style="font-size:12px;" align="left" height="5" width="68" valign="top"  scope="col"><strong>Entrega:</strong>  </th>
            <th align="left" height="5" width="70" valign="top"  scope="col"><?PHP echo $fecha; ?></th>
          </tr>
          <tr>
            <th style="font-size:12px;" align="left" valign="top"  scope="col">Hora:</th>
            <th align="left" valign="top"  scope="col"><?PHP echo $hora; ?></th>
          </tr>
          <tr>
            <th style="padding-left:3px" width="282"  scope="col">PENDIENTE</th>
            <th colspan="2" align="center" valign="middle" class="Estilo2"  scope="col">Nro Orden: <?PHP echo $solicitud;?></th>
          </tr>
        </table>
        <table class="rejilla" width="650" border="0" align="center" cellpadding="0" bgcolor="#CCCCCC">
          <tr>
            <td align="center"><span class="Estilo2"><strong>FORMATO  SOLICITUD DE MATERIAL</strong></span></td>
          </tr>
        </table>
        
        <table class="rejilla_titulo" width="650" border="0" align="center" cellpadding="0">
          <tr>
            <th align="left" height="1" colspan="7" class="Estilo2"  scope="col"><hr></th>
          </tr>
          <tr>
            <th style="padding-left:3px" align="left" height="0" colspan="2" class="Estilo2"  scope="col">Area solicitante: </th>
            <th height="0" colspan="2" align="left" class="Estilo2"  scope="col"><?PHP echo $areasolicitante?></th>
            <th style="font-size:10px" height="0" colspan="3" align="left" class="Estilo2"  scope="col">Fecha Soli:<br>
            <?PHP echo $fecha_crea?></th>
          </tr>
          <tr>
            <th align="left" height="1" colspan="7" class="Estilo2"  scope="col"><hr></th>
          </tr>
          <tr>
            <th width="41" 	height="15" bgcolor="#CCCCCC"  scope="col">#item</th>
            <th width="84" bgcolor="#CCCCCC"  scope="col">Codigo</th>
            <th width="372" align="left"  	bgcolor="#CCCCCC"  scope="col">Descripcion</th>
            <th width="42" align="center" 	bgcolor="#CCCCCC"  scope="col">Bulto</th>
            <th width="58" align="center" 	bgcolor="#CCCCCC"  scope="col">Paquete</th>
            <th width="39" align="center" 	bgcolor="#CCCCCC"  scope="col">Unidad</th>
          </tr>
        
        <?PHP        
	 		while( $rows = sqlsrv_fetch_array($rst)) {         
        ?>
         <tr>            
            <th style="padding-left:3px" 	align="center" height="15" 	scope="col"><?PHP echo $rows[1] ?></th>
            <th style="padding-left:3px" 	align="center" height="15" 	scope="col"><?PHP echo $rows[2] ?></th>
            <th style="padding-left:3px" 	align="left" 				scope="col"><?PHP echo $rows[3] ?></th>
            <th style="padding-left:3px" 	align="center" 				scope="col"><?PHP echo $rows[4] ?></th>
            <th style="padding-left:3px"	align="center" 				scope="col"><?PHP echo $rows[5] ?></th>
            <th atyle="padding-left:3px"	align="center"				scope="col"><?PHP echo $rows[6] ?></th>            
          </tr>
        <?PHP }  ?>        
          <tr>
            <th height="15" colspan="7" align="left"  	scope="col"><hr></th>  
          </tr>
          
          <tr>
            <th height="5" 	colspan="7" 	align="left" valign="middle" bgcolor="#CCCCCC"  	scope="col">&nbsp;</th>
          </tr>
        </table>
          
        <table class="rejilla_titulo"  width="650" border="0" align="center" cellpadding="0">
        <tr>
        <th height="10" colspan="2"  scope="col"><hr></th>
        </tr>
        <tr bgcolor="#CCCCCC">
        <th   height="25" align="left"  scope="col">&nbsp;&nbsp;Entregado Por:</th>
        <th align="left"  scope="col">Recibido Por:&nbsp;&nbsp;&nbsp;&nbsp; </th>
        </tr>
        <tr bgcolor="#FFFFFF">
          <th   height="25" align="center"  scope="col"><?php echo $nombrep?> <br><?php echo $cargop?></th>
          <th align="center"  scope="col"><?php echo $recibido?> <br><?php echo $cargo_recibido?> </th>
        </tr>
        </table>
  </td>
  </tr>
</table>

</div>


</body>
</html>
