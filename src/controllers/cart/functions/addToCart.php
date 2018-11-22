<?php
function addToCart($productId, $userId, $amount, $db){
    $query = "INSERT INTO cart_items (product_id, id, amount) VALUES ($productId, $userId, $amount)";
    $insertCartQuery = $db->query($query);
    if($insertCartQuery) { // was query a success?
        $response = 1;  

    } else {
        $response = $db->errorInfo(); 
    }
    
    $res = new \Slim\Http\Response();
    $res->setStatus(400);
    $res->headers->set('Content-Type', 'application/json');
    echo json_encode($response);
}
?>