<?php
        require_once('functions/inventoryItems.php');
        $items = inventoryItems($db);
        echo $twig->render('inventory/listings.html', array('app' => $app, 'netId' => $netId, 'items' => $items, 'cartItems' => $cartItems ));

?>