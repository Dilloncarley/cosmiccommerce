<?php
function itemIsInStock($db, $productId){
    $query = "SELECT quantity FROM inventory_items WHERE product_id = $productId";
    $isInStock = $db->query($query)->fetchColumn();
    if($isInStock != 0) return true; 
    else return false;
}
function itemAlreadyInCart($db, $productId, $userId){
    $query = "SELECT product_id FROM cart_items WHERE product_id = $productId and id = $userId";
    $itemInCart = $db->query($query)->fetchColumn();
    if($itemInCart) return true;
    else return false;
}
function incrementCartItem($db, $productId, $userId){
    $query = "UPDATE cart_items SET amount = amount + 1 WHERE product_id = $productId and id = $userId";
    $db->query($query);
}
function decrementInventoryItem($db, $productId, $userId){
    $query = "UPDATE inventory_items SET quantity = quantity - 1 WHERE product_id = $productId";
    $db->query($query);
}
function cartItem($db, $productId){
    $query = "SELECT * FROM inventory_items WHERE product_id = $productId";
    return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
}
function addToCart($productId, $userId, $amount, $db){
    //first check if item is in stock
    $isInStock = itemIsInStock($db, $productId);

    if($isInStock){
        
        //second check if item is already added to card, if so then increment it
        $itemAlreadyInCart = itemAlreadyInCart($db, $productId, $userId);

        if($itemAlreadyInCart){

            incrementCartItem($db, $productId, $userId);

            //decrement quantity from inventory items table
            decrementInventoryItem($db, $productId, $userId);
            $cartItemArray = cartItem($db, $productId);
                $messageArray =  array( 'cartItem' => $cartItemArray, 
                'status' => "5"); 
            $response = $messageArray;
        } else {
            //if not already in cart add it
            $query = "INSERT INTO cart_items (product_id, id, amount) VALUES ($productId, $userId, $amount)";
            $insertCartQuery = $db->query($query);
            if($insertCartQuery) { // was query a success?
                decrementInventoryItem($db, $productId, $userId);
                $cartItemArray = cartItem($db, $productId);
                $messageArray =  array( 'cartItem' => $cartItemArray, 
                'status' => "5"); 
                $response = $messageArray ;

            } else {
                $errorArray = array( 'message' => $db->errorInfo(), 
                'status' => "0");
                $response = $errorArray;
            }

        }
    } else {
        $outOfStockArray = array( 'productId' => $productId, 
        'status' => "3" );
        $response = $outOfStockArray;
    }
    
    
    
    $res = new \Slim\Http\Response();
    $res->setStatus(400);
    $res->headers->set('Content-Type', 'application/json');
    echo json_encode($response);

    $db = null;
}
?>