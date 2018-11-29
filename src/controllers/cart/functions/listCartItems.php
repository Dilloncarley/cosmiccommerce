<?php
function listCartItems($db, $user_id ){
    
        $query = "SELECT cart_items.id, cart_items.product_id, cart_items.amount,
        inventory_items.item_name, inventory_items.product_image, inventory_items.sub_descrip, inventory_items.item_type, inventory_items.price
        FROM cart_items
        INNER JOIN inventory_items ON cart_items.id = $user_id and cart_items.product_id = inventory_items.product_id";
    $foundCartItems = $db->query($query);

    if($foundCartItems) return $foundCartItems;
    else return $db->errorInfo();
    }
 

 ?>