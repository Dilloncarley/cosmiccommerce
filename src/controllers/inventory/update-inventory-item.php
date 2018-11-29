<?php

    require_once('functions/updateItems.php');

    $item_name = $app->request->post('itemName');
    $quantity = $app->request->post('itemQuantity');
    $sub_descrip = $app->request->post('itemSubDescrip');
    $main_descrip = $app->request->post('itemDescrip');
    $item_type = $app->request->post('itemType');
    $product_image = $app->request->post('itemURL');

    updateInvItem($item_name, $quantity, $sub_descrip, $main_descrip, $product_image, $item_type, $id, $db);

?>