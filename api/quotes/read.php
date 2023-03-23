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

    // Quote query
    $result = $quote->read();

    // Get row count
    $num = $result->rowCount();

    // check if any quotes
    if($num > 0) {
        // Quote array
        $quote_arr = array();
        $quote_arr['data'] = array();

        while($row = result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $quote_item = array(
                'id' => $id,
                'quote' => html_entity_decode($body),
                'author' => $author_id,
                'category' => $category_id
            );

            // Push to "data"
            array_push($quote_arr['data'], $quote_item);
        }

        // Turn to JSON & output
        echo json_encode($quote_arr);

    } else {
        // No quotes
        echo json_encode(
            array('message' => 'No quote found')
        );

    }