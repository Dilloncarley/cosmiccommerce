<?php
        function searchItem($item_name, $item_type, $db){ //user entry for name, user selection for type

            $queryAllItems = "SELECT * FROM inventory_items";
            $queryItemNamesAndFilter = "SELECT * FROM inventory_items WHERE item_type LIKE '$item_type' AND item_name LIKE '$item_name%' ";
            $queryAllFilter =  " SELECT * FROM inventory_items WHERE item_type LIKE '$item_type'";
            $queryAllNames = "SELECT * FROM inventory_items WHERE item_name LIKE '$item_name%'";
            if(empty($item_name) AND empty($item_type)){
                return $db->query($queryAllItems);
            } else if(empty($item_name)){

                return $db->query($queryAllFilter);
            } else if (empty($item_type)) {

                return $db->query($queryAllNames);
            } else{
                return $db->query($queryItemNamesAndFilter);
            }
           
        }

?>