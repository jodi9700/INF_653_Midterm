<?php
    // Headers
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
        Access-Control-Allow-Methods,Authorization,X-Requested-With');

    include_once '../../config/Database.php;';
    include_once '../../models/Quote.php;';

    // Intantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quote($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update
    $quotes->id = $data->id;

    // Delete quote
    if($quotes->delete()) {
        echo json_encode(
            array('message' = 'Quote Deleted')
        );
    } else {
        echo json_encode(
            array('message' = 'Quote Not Deleted')
        );
    }