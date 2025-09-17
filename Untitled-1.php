<?php
require('fpdf186/fpdf.php');

// Crear una nueva instancia de la clase FPDF
$pdf = new FPDF();

// Establecer el formato de página a A4 (o cualquier otro formato de tu elección)
$pdf->AddPage('P', 'A4');

// Establecer la fuente a Arial, negrita, tamaño 14
$pdf->SetFont('Arial', 'B', 14);

// Consulta a la base de datos para obtener los datos
$query = "SELECT fecha, nombre, total FROM tabla"; // Reemplaza "tabla" con el nombre de tu tabla
$result = mysqli_query($conn, $query);

// Variables para la paginación
$records_per_page = 10;
$total_records = mysqli_num_rows($result);
$total_pages = ceil($total_records / $records_per_page);

// Bucle para cada página
for ($page=1; $page<=$total_pages; $page++) {
    // Calcular el primer registro de la página actual
    $start_from = ($page-1) * $records_per_page;

    // Consulta a la base de datos para obtener los registros de la página actual
    $query = "SELECT fecha, nombre, total FROM tabla LIMIT $start_from, $records_per_page"; // Reemplaza "tabla" con el nombre de tu tabla
    $result = mysqli_query($conn, $query);

    // Bucle para cada registro
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(40, 10, $row['fecha'], 1);
        $pdf->Cell(100, 10, $row['nombre'], 1);
        $pdf->Cell(50, 10, $row['total'], 1, 1); // El último parámetro "1" indica que este es el final de la fila y que la siguiente celda debe comenzar en una nueva fila
    }

    // Agregar una nueva página si no es la última página
    if ($page != $total_pages) {
        $pdf->AddPage('P', 'A4');
    }
}

// Generar el PDF
$pdf->Output();
?>
