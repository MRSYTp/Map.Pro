<?php 
include "../bootstrap/init.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    echo "OK";
    // دریافت داده‌های JSON ارسال شده از کلاینت
    $input = json_decode(file_get_contents('php://input'), true);

    $latitude = $input['latitude'];
    $longitude = $input['longitude'];
    $radius = $input['radius']; // شعاع جستجو به کیلومتر

    // شامل کردن فایل فانکشن برای جستجوی مکان‌ها
    include 'functions.php';

    // فراخوانی فانکشن برای دریافت مکان‌ها از دیتابیس
    $locations = getNearbyLocations($latitude, $longitude, $radius);

    // بازگشت نتایج به‌صورت JSON
    echo json_encode($locations);
}