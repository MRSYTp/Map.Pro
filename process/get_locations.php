<?php 
include "../bootstrap/init.php";

// تنظیم هدر برای JSON
header('Content-Type: application/json');

// دریافت داده‌های JSON از کلاینت
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['latitude']) || !isset($input['longitude']) || !isset($input['radius'])) {
    echo json_encode(['error' => 'Invalid input data']);
    http_response_code(400);
    exit;
}

// مختصات و شعاع جستجو
$latitude = $input['latitude'];
$longitude = $input['longitude'];
$radius = $input['radius'];

try {
    // فراخوانی فانکشن و دریافت مکان‌های نزدیک
    $locations = getNearbyLocations($latitude, $longitude, $radius);

    // بازگشت داده‌ها به صورت JSON
    echo json_encode($locations);
} catch (Exception $e) {
    // مدیریت خطاها
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
