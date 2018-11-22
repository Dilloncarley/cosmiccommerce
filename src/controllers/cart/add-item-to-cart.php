<?php
    require_once('functions/addToCart.php');

    $proName = $app->request->post('product_name');
    $amount = $app->request->post('amount');
    $userId = $app->request->post('user_id');

    addToCart($id, $userId, $amount, $db);


?>