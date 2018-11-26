<?php
    function createInvItem($item_name, $quantity, $sub_descrip, $main_descrip, $product_image, $item_type, $db)
    {
        $query = "INSERT INTO inventory_items (item_name, quantity, product_image, main_descrip, sub_descrip, item_type )" 
        . "VALUES(  '$item_name', $quantity, '$product_image', '$main_descrip', '$sub_descrip', '$item_type' )";

        $db->query($query);
        
        //$error = $db->errorInfo(); view sql errors
        //print_r($error);
    }
?>