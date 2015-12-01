<?php
$lines = file('hsr.csv');
foreach ($lines as $line) {
    $stations[] = str_getcsv($line);
}

// remove keys.
unset($stations[0]);

$geometry = [
    'type' => 'Point'
];

foreach ($stations as $station) {
    list($id, $name, $zipcode, $address, $lat, $lon) = $station;

    $geometry['coordinates'] = [(float) $lon, (float) $lat];
    $properties = [
        '編號' => (string) $id,
        '站名' => $name,
        '郵遞區號' => (int) $zipcode,
        '地址' => $address,
        '緯度' => (float) $lat,
        '經度' => (float) $lon
    ];

    $feature = [
        'type' => 'Feature',
        'geometry' => $geometry,
        'properties' => $properties
    ];

    $features[] = $feature;
}

$geojson = [
    'type' => 'FeatureCollection',
    'features' => $features
];

echo json_encode($geojson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
