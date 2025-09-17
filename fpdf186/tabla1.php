<?php
require('fpdf.php');
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
		// Colores, ancho de línea y fuente en negrita
		$this->SetFillColor(255,0,0);
		$this->SetTextColor(255);
		$this->SetDrawColor(128,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		// Cabecera
		$w = array(20, 45, 25, 20,30);
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
			
			$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
			$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
			$this->Cell($w[2],6,($row[2]),'LR',0,'R',$fill);
			$this->Cell($w[3],6,($row[3]),'LR',0,'R',$fill);
			$this->Cell($w[4],6,$row[4],'LR',0,'L',$fill);
			$this->Ln();
			$fill = !$fill;
		}
		// Línea de cierre
		$this->Cell(array_sum($w),0,'','T');
	}	
	
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

// Crear encabezado de la tabla
$header = array('id', 'gerencia', 'horario', 'cantidad', 'fecha');


$qry = " SP_BUS_LOGISTICA_FECHA_INI_FIN '".$txt_fecha_ini."','".$txt_fecha_fin."'";	
$rst = sqlsrv_query( $conn, $qry, array(), array("Scrollable"=>"buffered"));
if (! $rst) {  
   echo "Error en la ejecuci?n de la instrucci?n ".$qry.".\n";
   die( print_r2( sqlsrv_errors(), true));  
   exit;
}

$data = array();
$rowCount = sqlsrv_num_rows( $rst );

if($rowCount > 0) {
	while( $row = sqlsrv_fetch_array( $rst) ) {	
        $data[] = array($row["id"], $row["gerencia"], $row["horario"], $row["cantidad"], $row["fecha"]);
    }
} else {
    echo "0 results";
}

$pdf->FancyTable($header,$data);
$pdf->Output();
?>