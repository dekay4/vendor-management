<?php

require_once '../includes/simplexlsxgen-master/src/SimpleXLSXGen.php';

// Connect to DB
include('../includes/connection.php');

$result = $conn->query("SELECT * FROM vendor");

$data = [
    ['Vendor name', 'Email', 'Mobile no', 'Working hrs', 'Threat Score', 'Status']
];

// Loop through data
while ($row = $result->fetch_assoc()) {
    $rawScore = trim($row['threat_score']);
    $score = is_numeric($rawScore) ? (int)$rawScore : 0;

    // Apply color based on score
    if ($score >= 70) {
        // $scoreCell = [
        //     'val' => $score,
        //     'style' => 'background-color:#f44336;color:#fff'
        // ];
        $scoreCell = '<b><style color="#FF0000">' . $score . '</style></b>';
    } elseif ($score >= 40) {
        // $scoreCell = [
        //     'val' => $score,
        //     'style' => 'background-color:#ffeb3b;color:#000'
        // ];
        $scoreCell = '<b><style color="#ffeb3b">' . $score . '</style></b>';
    } else {
        // $scoreCell = [
        //     'val' => $score,
        //     'style' => 'background-color:#4caf50;color:#fff'
        // ];

        $scoreCell = '<b><style color="#4caf50">' . $score . '</style></b>';
    }

    print_r($scoreCell);



    $data[] = [
        $row['vendor_name'],
        $row['vendor_email'],
        $row['vendor_mobile'],
        $row['working_hrs'],
        $scoreCell,
        $row['status']
    ];
}


\Shuchkin\SimpleXLSXGen::fromArray($data)->downloadAs('vendors.xlsx');
