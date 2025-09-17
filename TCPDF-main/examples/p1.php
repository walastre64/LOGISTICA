<?php
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE'); # Localiza en espa�ol es_Venezuela
date_default_timezone_set('America/Caracas');
include("../../conexion/conexionsqlsrv.php");
include("../../validacion/validacion_general2.php");
include('../../restringir/restringir.ini.php');
// ------------------------------------------------->
//session_valida();
$conn = conectate();
session_start();


//require_once('../tcpdf/tcpdf.php');
require_once('tcpdf_include.php');
// Clase personalizada que extiende TCPDF
class MyPDF extends TCPDF {
    // Función para generar filas de la tabla
    public function generateRow($data) {
        $content = '';
        foreach ($data as $row) {
            $content .= "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['gerencia']}</td>
                    <td>{$row['horario']}</td>
                    <td>{$row['cantidad']}</td>
                </tr>";
        }
        return $content;
    }

    // Función para crear el PDF
    public function createPDF($data) {
        $this->AddPage();

        // Configura la tabla
        $html = "
            <table border='1'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    {$this->generateRow($data)}
                </tbody>
            </table>";

        $this->writeHTML($html, true, false, false, false, '');
    }
}

// Ejemplo de uso

    // Aquí debes obtener los datos de tu consulta SQL
$qry = "
SELECT 
	 ROW_NUMBER() OVER (ORDER BY id_logistica desc) AS id,	dbo.M_GERENCIA.gerencia as gerencia , 	dbo.M_HORARIO.horario as horario, 	dbo.M_LOGISTICA.cantidad as cantidad, 	CONVERT(varchar(10), dbo.M_LOGISTICA.fecha, 103) AS fecha
FROM            
	dbo.M_LOGISTICA 
INNER JOIN 
	dbo.M_GERENCIA 
ON 
	dbo.M_LOGISTICA.id_gerencia = dbo.M_GERENCIA.id_gerencia 
INNER JOIN
   dbo.M_HORARIO 
ON 
	dbo.M_LOGISTICA.id_horario = dbo.M_HORARIO.id_horario
ORDER BY 
	id,gerencia
";
	
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

$pdf = new MyPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("Reporte de Productos");
$pdf->SetHeaderData('', '', 'Reporte de Productos', 'Generado por TCPDF');
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
$pdf->SetFont('helvetica', '', 10);

// Divide los datos en grupos de 40 registros por página
$chunks = array_chunk( $data, 40);
foreach ($chunks as $chunk) {
    $pdf->createPDF($chunk);
}

// Genera el PDF
$pdf->Output('reporte_productos.pdf', 'I');
?>
