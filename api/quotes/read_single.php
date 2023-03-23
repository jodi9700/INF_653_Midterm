<?php
    // Headers
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php;';
    include_once '../../models/Quote.php;';

    // Intantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quote($db);

    // Get ID
    $quotes->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get quote
    $quote->read_single();

    // Create array
    $quote_array = array(
        'id' = $quotes->id,
        'quote' => $quotes->quote,
        'category' => $quotes->category_id,
        'author' => $quotes->author_id
    );

    // Make JSON
    print_r(json_encode($quote_array));