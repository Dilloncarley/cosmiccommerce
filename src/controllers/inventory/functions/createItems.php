<?php
    function createInvItem($item_name, $quantity, $sub_descrip, $main_descrip, $product_image, $item_type, $price, $db)
    {
        $query = "INSERT INTO inventory_items (item_name, quantity, product_image, main_descrip, sub_descrip, item_type, price )" 
        . "VALUES(  '$item_name', $quantity, '$product_image', '$main_descrip', '$sub_descrip', '$item_type', $price )";

        $db->query($query);
        
        //$error = $db->errorInfo(); view sql errors
        //print_r($error);
    }
?>