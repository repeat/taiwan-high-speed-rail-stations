<?php
$lines = file('hsr.csv');
foreach ($lines as $line) {
    $stations[] = str_getcsv($line);
}
echo json_encode($stations, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);