<?php
    function inventoryItems($db){
        $query = "SELECT * FROM inventory_items";
        $foundInventoryItems = $db->query($query);

        if($foundInventoryItems) return $foundInventoryItems;
            else return $db->errorInfo();
    }

    function individualInventoryItems($id, $db){
        $query = "SELECT item_name, quantity, product_image, main_descrip, sub_descrip, item_type
         FROM inventory_items WHERE product_id = $id";

        $displayInventoryItem = $db->query($query);

        if($displayInventoryItem) return $displayInventoryItem;
            else return $db->errorInfo();
    }
?>