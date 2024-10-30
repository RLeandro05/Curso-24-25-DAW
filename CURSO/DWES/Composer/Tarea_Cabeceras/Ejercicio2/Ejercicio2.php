<?php
    require __DIR__ . "/../../vendor/autoload.php";

    use Fpdf\Fpdf;

    $nombreArchivo = "saludo.pdf";

    // Cabeceras para la descarga del PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="'.$nombreArchivo.'"');

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Hola Mundo'); // Añade un ancho y alto para la celda
    $pdf->Output('D', $nombreArchivo); // 'D' para forzar la descarga
?>
