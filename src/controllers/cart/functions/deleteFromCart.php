<?php
function incrementInventoryItem($db, $amount, $productId){
    $query = "UPDATE inventory_items SET quantity = quantity + $amount WHERE product_id = $productId";
    $db->query($query);
}
function deleteFromCart($db, $amount, $id, $user_id){
    //check amount first
    $query = "SELECT amount FROM cart_items WHERE id= $user_id AND product_id = $id";
    $cartItemAmountInDb = $db->query($query)->fetchColumn();

    //delete all 
    if($amount == "all"){
        incrementInventoryItem($db,  $cartItemAmountInDb, $id);
        $query = "DELETE FROM cart_items WHERE id= $user_id AND product_id = $id";
        $db->query($query);
       
        $response = 1;
    } else {
        $response = 1;
    }

    $res = new \Slim\Http\Response();
    $res->setStatus(400);
    $res->headers->set('Content-Type', 'application/json');
    echo json_encode($response);

    $db = null;

}

?>