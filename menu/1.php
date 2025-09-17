<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE'); # Localiza en espa�ol es_Venezuela
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
//include('file:///C|/xampp/htdocs/restringir/restringir.ini.php');
// ------------------------------------------------->
//session_valida();
$conn = conectate();
session_start();

$usuario = $_SESSION['nombre'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

    <div>
      <div style="display: inline-block; width: 33%; background-color: #f1f1f1;">

      
      <div id="botones">
        
        <select id="cbo_gerencia" class="form-control form-select form-select-sm mb-3" aria-label="Selecione la Gerencia">
          <option value="0" selected>- Selecione la Gerencia -</option>
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
	   </div> 
	
      
      <div style="display: inline-block; width: 33%; background-color: #f1f1f1;"> 
      <div id="botones">
        
        <select id="cbo_gerencia" class="form-control form-select form-select-sm mb-3" aria-label="Selecione la Gerencia">
          <option value="0" selected>- Selecione la Gerencia -</option>
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
	   </div>       
      </div> 
      <div style="display: inline-block; width: 33%; background-color: #f1f1f1;"> 
      <div id="botones">
        
        <select id="cbo_gerencia" class="form-control form-select form-select-sm mb-3" aria-label="Selecione la Gerencia">
          <option value="0" selected>- Selecione la Gerencia -</option>
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
	   </div>       
      </div> 

     
    
    <div style="background-color: #f1f1f1;">Div 4</div>
</body>
</html>