<?php

$item_name = $app->request->post('itemName');
$quantity = $app->request->post('itemQuantity');
$sub_descrip = $app->request->post('itemSubDescrip');
$main_descrip = $app->request->post('itemDescrip');
$item_type = $app->request->post('itemType');
$product_image = $app->request->post('itemURL');
$product_id = $app->request->post('product_id');


function updateInvItem($item_name, $quantity, $sub_descrip, $main_descrip, $product_image, $item_type, $product_id, $db)
{
    $query = "UPDATE inventory_items SET item_name = '$item_name', quantity = $quantity, product_image = '$product_image', main_descrip = '$main_descrip', sub_descrip = '$sub_descrip', item_type ='$item_type' WHERE product_id = '$product_id'";

    $db->query($query);
    
    //$error = $db->errorInfo(); view sql errors
    //print_r($error);
}

updateInvItem($item_name, $quantity, $sub_descrip, $main_descrip, $product_image, $item_type, $product_id, $db);

?>