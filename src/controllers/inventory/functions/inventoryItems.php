<?php
    function inventoryItems($db){
        $query = "SELECT * FROM inventory_items WHERE quantity <> 0";
        $foundInventoryItems = $db->query($query);

        if($foundInventoryItems) return $foundInventoryItems;
        else return $db->errorInfo();
    }
?>