<?php
require('fpdf.php');

class PDF extends FPDF
{
    // Encabezado
    function Header()
    {
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,'Este es el encabezado',0,1,'C');
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }

    // Tabla avanzada
    function AdvancedTable($header, $data)
    {
        // Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        
        // Encabezado
        $w = array(40, 35, 40, 45);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        
        // Restauración de colores y fuentes
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        
        // Datos
        $fill = false;
        $rowCount = 0;
        foreach($data as $row)
        {
            for($i=0;$i<count($row);$i++)
                $this->Cell($w[$i],6,$row[$i],'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
            $rowCount++;
            
            // Añadir una nueva página después de 15 filas
            if ($rowCount % 15 == 0) {
                $this->AddPage();
            }
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
$header = array('id_logistica', 'id_gerencia', 'id_horario', 'cantidad', 'fecha');

// Crear datos de la tabla
$data = array();
for ($i=0; $i<30; $i++) {
    $data[] = array('Fila '.($i+1).' - Col 1', 'Fila '.($i+1).' - Col 2', 'Fila '.($i+1).' - Col 3', 'Fila '.($i+1).' - Col 4', 'Fila '.($i+1).' - Col 5');
}

// Añadir la tabla al PDF
$pdf->AdvancedTable($header,$data);

$pdf->Output();
?>
