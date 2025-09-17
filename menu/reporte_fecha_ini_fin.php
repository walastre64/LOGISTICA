<?php
require('../fpdf186/fpdf.php');
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


$txt_fecha_ini	= ($_GET['txt_fecha_ini']);
$txt_fecha_fin	= ($_GET['txt_fecha_fin']);
$cbo_reporte	= ($_GET['cbo_reporte']);

$totalCantidad = 0;

function dia_final_mes($fecha){
	
	$ano = substr($fecha,6,4);
	$mes = substr($fecha,3,2); 	
	
	return $day = date("d", mktime(0,0,0, $mes+1, 0, $ano));
	
};
function dia_inicial_mes($fecha){
	
	$ano = substr($fecha,6,4);
	$mes = substr($fecha,3,2); 	
	
	return $day = date("d", mktime(0,0,0, $mes, 1, $ano));
	
};

class PDF extends FPDF
{
	
	
	private $headerTitle; // Título de la tabla

    public function setHeaderTitle($title) {
        $this->headerTitle = $title;
    }	
    
	// Encabezado
    function Header()
    {
        $fecha = date("d/m/Y");

        // Logo////////////////////////////////////////////////
	    $this->Image('../imagenes/JPG/bahia.jpg',10,5,45);
		
		// salto de linea ////////////////////////////////////
		$this->Ln(10); 
		
		$this->SetFont('Arial','B',12);
        $this->Cell(50);	       
	    $this->Cell(0,10,'Logistica -'.$fecha,0,1,'C');

		$this->Cell(0, 10, $this->headerTitle, 0, 1, 'C');
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
	

	
// Tabla coloreada
	function FancyTable($header, $data)
	{
		$totalCantidad = 0;
		
		// Colores, ancho de línea y fuente en negrita
		$this->SetFillColor(255,0,0);
		$this->SetTextColor(255);
		$this->SetDrawColor(128,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		// Cabecera
		$w = array(45, 25, 20,30);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		$this->Ln();
		// Restauración de colores y fuentes
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Datos
		$fill = false;
		foreach($data as $row)		{
			
			
			$this->Cell($w[0],6,utf8_decode($row[1]),'LR',0,'L',$fill);
			$this->Cell($w[1],6,($row[2]),'LR',0,'R',$fill);
			$this->Cell($w[2],6,($row[3]),'LR',0,'R',$fill);
			$this->Cell($w[3],6,$row[4],'LR',0,'L',$fill);
									
			$this->Ln();
						
			$fill = !$fill;
			
			
			
		}
		// Línea de cierre
		//$this->Cell(array_sum($w),0,'','T');
	}	
	
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

// Crear encabezado de la tabla
$header = array('Gerencia', 'Horario', 'Cantidad', 'Fecha');

// rango de fecha
if($cbo_reporte == 4){ 
	$qry = " SP_BUS_LOGISTICA_FECHA_INI_FIN '".$txt_fecha_ini."','".$txt_fecha_fin."'";	
	//echo $qry;

// diario
}else if($cbo_reporte == 1){
	$qry = " SP_BUS_LOGISTICA_FECHA_INI_FIN '".$txt_fecha_ini."','".$txt_fecha_ini."'";	
	//echo $qry;

// rango mensual
}else if($cbo_reporte == 2){
	
	
	$diaI = dia_inicial_mes($txt_fecha_ini);
	$mesI = substr($txt_fecha_ini,3,2);
	$anoI = substr($txt_fecha_ini,6,4);	
	$txt_fecha_ini = $diaI."/".$mesI."/".$anoI;
	
	$diaF = dia_final_mes($txt_fecha_ini);
	$mesF = substr($txt_fecha_ini,3,2);
	$anoF = substr($txt_fecha_ini,6,4);	
	$txt_fecha_fin = $diaF."/".$mesF."/".$anoF;	
	
	$qry = "SP_BUS_LOGISTICA_FECHA_INI_FIN '".$txt_fecha_ini."','".$txt_fecha_fin."'";	
	//echo $qry;

}else if($cbo_reporte == 3){
	
	$qry = "SP_BUS_LOGISTICA_GERENCIA_FECHA_INI_FIN '".$txt_fecha_ini."','".$txt_fecha_fin."',''";
	//echo $qry;
}else if($cbo_reporte == 5 || $cbo_reporte == 6 || $cbo_reporte == 7){
	
	if($cbo_reporte == 5){
		$cbo_reporte = 'AM';
	}else if($cbo_reporte == 6){
		$cbo_reporte = 'PM';
	}else if($cbo_reporte == 7)	{
		$cbo_reporte = 'AMANECER';	
	}
	
	$qry = "SP_BUS_LOGISTICA_GERENCIA_FECHA_INI_FIN '".$txt_fecha_ini."','".$txt_fecha_fin."','".$cbo_reporte."'";
	//echo $qry;
}




//echo $qry;
$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
if (! $rst) {  
   echo "Error en la ejecuci?n de la instrucci?n ".$qry.".\n";
   die( print_r2( sqlsrv_errors(), true));  
   exit;
}

$data = array();
$rowCount = sqlsrv_num_rows( $rst );

$totalCantidad = 0;

if($rowCount > 0) {
	while( $row = sqlsrv_fetch_array( $rst) ) {	
	
		$totalCantidad = $totalCantidad + $row["cantidad"];
        $data[] = array($row["id"], $row["gerencia"], $row["horario"], $row["cantidad"], $row["fecha"]);
    }
} else {
	echo "Sin Datos para las Fechas solicitadas ...";
	echo "<script>alert('Sin Datos para las Fechas solicitadas ...!!!');</script>";	
	return;
}





$pdf->FancyTable($header,$data);

// Agrega la fila de suma total

$pdf->Cell(45,5,'Totales',1,0,'C',true);
$pdf->Cell(25,5,'-->',1,0,'C',true);
$pdf->Cell(20,5,$totalCantidad,1,0,'C',true);
$pdf->Cell(30,5,'-',1,0,'C',true);

//$pdf->Cell(5,0,'','T');


$pdf->Output();
?>