<?php
require('../includes/fpdf.php');
include('../includes/connection.php');


// Fetch Data
$result = $conn->query("SELECT * FROM vendor");
if (!$result || $result->num_rows === 0) {
    die("No data found.");
}

// PDF Init
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Table Header
$header = ['Vendor Name', 'Email', 'Mobile No', 'Working Hrs', 'Threat Score', 'Status'];
foreach ($header as $col) {
    $pdf->Cell(32, 10, $col, 1);
}
$pdf->Ln();

// Table Rows
$pdf->SetFont('Arial', '', 10);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(32, 10, $row['vendor_name'], 1);
    $pdf->Cell(32, 10, $row['vendor_email'], 1);
    $pdf->Cell(32, 10, $row['vendor_mobile'], 1);
    $pdf->Cell(32, 10, $row['working_hrs'], 1);

    // Threat Score with basic coloring logic
    $score = (int) $row['threat_score'];
    $fillColor = [255, 255, 255]; // default white
    if ($score >= 70) $fillColor = [244, 67, 54];     // red
    elseif ($score >= 40) $fillColor = [255, 235, 59]; // yellow
    else $fillColor = [76, 175, 80];                  // green

    $pdf->SetFillColor(...$fillColor);
    $pdf->Cell(32, 10, $score, 1, 0, 'C', true); // fill = true
    $pdf->SetFillColor(255, 255, 255); // reset fill

    $pdf->Cell(32, 10, $row['status'], 1);
    $pdf->Ln();
}

$pdf->Output('D', 'vendors.pdf'); // D = download
