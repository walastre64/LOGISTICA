<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE'); # Localiza en espa�ol es_Venezuela
date_default_timezone_set('America/Caracas');
include("conexion/conexionsqlsrv.php");
include("validacion/validacion_general2.php");
include('restringir/restringir.ini.php');
// ------------------------------------------------->
//session_valida();
$conn = conectate();
session_start();

function salida()
{
	header("location: index.php");
}

$usuario 	= $_SESSION['nombre'];
$rol 	 	= $_SESSION['rol'];
$id_usuario	= $_SESSION['id_usuario'];

$fecha = '';

if($rol == 9)
{
	$fecha = '';
	$id_usuario = 0;
}
else
	$fecha = date("d/m/Y"); 


$fecha_logistica = date("d/m/Y");
if(isset($_POST['fecha_logistica'])){
	$fecha_logistica = $_POST['fecha_logistica'];}

$valor_elimina = '';
if(isset($_POST['valor_elimina'])){
	$valor_elimina = $_POST['valor_elimina'];}
?>

<!DOCTYPE html>
<html>
<head>

	<title>LOGISTICA</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Pragma"  content="no-cache" />
    
	<link rel="stylesheet" type="text/css" href="config_boostrap/bootstrap.min.css">
    <script src="config_jquery/jquery.min.js"></script>
    <script src="config_popper/popper.min.js"></script>
    <script src="config_boostrap/bootstrap.min.js"></script>  

    <link rel="shortcut icon" href="../imagenes/favicon.ico" type="image/x-ico"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link href="config_datatable/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="config_datatable/all.js" crossorigin="anonymous"></script>
    <script src="validacion/validacion_general.js"></script>

<style>
body {
  display: flex;
  flex-direction: column;
  height: 100vh;
  margin: 0;
}
.titulo {  	
   text-align:center; 
   background-color:#EDC150;
  
}

.div3 {
  flex-grow: 1; 
  width: 100%;
  border-radius: 20px;  
  border-style: solid;
  border-color: black;
  border-width: 1px; 
  border-radius: 20px; 
  padding:15px;
  background-image: url(imagenes/png/marcadeagua3.png);
  margin: 0;
}
.div0{
  margin: 0; 
  font-family:Georgia, 'Times New Roman', Times, serif; 
  text-align:center; 
  padding:10px;
}

#cbo_gerencia, #cbo_horario{
  display:block;
  height:35px;
  width:250px;
}
.container-fluid {
  /*max-height: 200px !important;*/
 
}



.botones, .botones2 {
    float: left;
    padding: 10px; /* Espacio entre los divs */
    border: 1px solid #ccc; /* Borde para visualizar los divs */
	background-color:#CFDCED;
}

.botones2 {

    flex-direction: column;
}
.botones2 input[type="button"] {
    margin-bottom: 10px; /* Espacio entre los botones */
}



.input-group{
  display:block;
 
}

#txt_cantidad{
  display:block;
  height:30px;
  width:70px;
}
</style>
</head>
<body>

<title>LOGISTICA</title>


<div class="titulo">
	<strong>Carga de Logística - Bahiasupermarket</strong>
</div>


<div class="div3" style="background-color:lightwhite;">
	<div class="card mb-1">
        <div class="card-header">
            <i class="fa fa-bars me-1"></i>
            Menu ¬  
        </div>
	</div> 

    <div class="container-fluid">
        <div class="card-header">
            <div class="botones" style="position: relative;">            
                <!-- BOTONES Y CBOS -->
                
                <select id="cbo_gerencia" class="form-control form-select form-select-sm mb-3" aria-label="Selecione la Gerencia">
                <option value="0" selected>- Gerencia -</option>
                <?PHP 
                $qry = "SET ANSI_NULLS ON SET ANSI_WARNINGS ON EXEC [dbo].[SP_BUS_GERENCIA] 0";
                $rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
                if (! $rst) {  
                echo "Error en la ejecución de la instrucción ".$qry.".\n";
                die( print_r2( sqlsrv_errors(), true));  
                exit;
                }
                while( $rowg = sqlsrv_fetch_array($rst)) { ?>
                <option value="<?PHP echo $rowg[0];?>"><?PHP echo $rowg[1];?></option>
                <?PHP }?>
                </select> 
				<hr>

                <select id="cbo_horario" class="form-control form-select form-select-sm mb-3" aria-label="Selecione el horario">
                    <option value="0" selected>- Horario -</option>
                    <option value="200">AM</option>
                    <option value="201">PM</option>
                    <option value="202">AMANECER</option>
                </select>

                
                <hr>
                <label style="font-size:10px; color:black;"  class="form-label" for="txt_cantidad"><strong>Personas</strong></label>
			  <input style="margin-bottom:10px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onKeyPress="return solonumeros(event)" step="1" min="1" max="20" maxlength="2" type="number" id="txt_cantidad" class="form-control" />
				 <?PHP if($rol == 9) {?>
              <button style="margin-top:10p;" id="btn_activa" class="btn btn-warning">- On -</button> 
                 <?PHP }?>   
            <div style="position: absolute; bottom: 0; right: 0;">
              <button style="margin-right:5px;" id="btn_grabar" class="btn btn-primary">Grabar</button>
                <button id="btn_eliminar" class="btn btn-danger" data-toggle="modal"  data-target="#div_eliminar">Eliminar</button>  
             
            </div>
                        
          </div>  <!-- FIN BOTONES  -->



  </div>
  
<div class="card-body" style="background-color:#f7f7f7">
    <table width="38%" class="display compact outerTable table table-sm table-bordered table-hover"  id="datatablesSimple" style="width:50%">
    
      <thead>
        <tr>
          <th width="25%">Gerencia</th>
          <th width="25%">Cantidad</th>
          <th width="50%">Horario</th>
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
                  <td><?PHP echo $rowlg['gerencia'];?> </td>
                  <td align="center"><?PHP echo $rowlg['cantidad'];?> </td>
                  <td><?PHP echo $rowlg['horario'];?>  </td>
                </tr>             
         <?PHP }?>
        </tbody>
    </table>
  
          
      </div>
    </div>
</div>
</body>
</html>
