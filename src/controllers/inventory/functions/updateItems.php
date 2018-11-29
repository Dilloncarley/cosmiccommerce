<?php
    function updateInvItem($item_name, $quantity, $sub_descrip, $main_descrip, $product_image, $item_type, $product_id, $price, $db)
    {
        $query = "UPDATE inventory_items SET item_name = '$item_name', quantity = $quantity, 
        product_image = '$product_image', main_descrip = '$main_descrip', sub_descrip = '$sub_descrip', 
        item_type ='$item_type', price = '$price' WHERE product_id = '$product_id'";

        $db->query($query);
        
        //$error = $db->errorInfo(); view sql errors
        //print_r($error);
    }
?>