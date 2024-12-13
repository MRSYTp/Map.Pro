<?php 
include "../bootstrap/init.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['north'], $input['south'], $input['east'], $input['west'])) {
        $north = $input['north'];
        $south = $input['south'];
        $east = $input['east'];
        $west = $input['west'];

        // Fetch locations
        $locations = getLocationsInBounds($north, $south, $east, $west);

        // Return as JSON
        header('Content-Type: application/json');
        echo json_encode($locations);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input']);
    }
}