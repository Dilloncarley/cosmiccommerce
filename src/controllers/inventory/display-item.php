<?php

    require_once('functions/inventoryItems.php');
    $product_id = $app->request->get('product_id');
    $individualItem = individualInventoryItems($id, $db);

?>