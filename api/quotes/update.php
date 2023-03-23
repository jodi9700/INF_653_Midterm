<?php
    // Headers
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
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

    $quotes->quote = $data->quote;
    $quotes->author_id = $data->author_id;
    $quotes->category_id = $data->category_id;

    // Update quote
    if($quotes->update()) {
        echo json_encode(
            array('message' = 'Quote Updated')
        );
    } else {
        echo json_encode(
            array('message' = 'Quote Not Updated')
        );
    }