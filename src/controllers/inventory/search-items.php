<?php

    require_once('functions/searchItems.php');

    $item_name = $app->request->post('userEntry');
    $item_type = $app->request->post('userSelection');

    $searchItems = searchItem($item_name, $item_type, $db);

?>