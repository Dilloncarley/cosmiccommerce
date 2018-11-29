<?php
    require_once('functions/addToCart.php');

    $proName = $app->request->post('product_name');
    
    

    addToCart($id, $user_id, 1, $db);


?>