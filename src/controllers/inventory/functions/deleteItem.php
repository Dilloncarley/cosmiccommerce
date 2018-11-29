<?php
        function removeItem($id, $db){

            $query = "DELETE FROM inventory_items WHERE product_id = $id";

            $db->query($query);
        }
?>