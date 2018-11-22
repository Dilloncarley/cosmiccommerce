<?php
    function inventoryItems($db){
        $query = "SELECT * FROM inventory_items";
        $foundInventoryItems = $db->query($query);

        if($foundInventoryItems) return $foundInventoryItems;
        else return $db->errorInfo();
    }
?>