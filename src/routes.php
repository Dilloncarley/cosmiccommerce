<?php 
session_start();

//all basic logic for authentication on production and local environments
require_once('auth/authController.php');

//landing page
$app->get('/', function () use ($app, $twig, $netId) {
    $allGetVars = $app->request->post();

    echo $twig->render('home.html', array('app' => $app, 'netId' => $netId));


})->setName('home');

$app->get('/404/:err', function($err) use ($app, $twig, $netId){
    echo $twig->render('404.html', array('app' => $app, 'netId' => $netId, 'error' => $err));

})->setName('error');

//login
$app->get('/login', function() use ($app, $twig, $db) {

    //auth through CAS system
    echo $app->render('casSystem.php', array('app' => $app, 'db' => $db));
  
});

//logout
$app->get('/logout', function() use ($app, $twig) {
    // remove all session variables
    session_unset(); 

    // destroy the session 
    session_destroy(); 
    
    $app->response->redirect($app->urlFor('home'));


});
$isAdmin = $adminValue($user_id, $db);
// ADMIN GROUP ROUTES
$app->group('/admin-dashboard', $authenticated($netId), $authenticateForRole($user_id, $db), function () use ($app, $twig, $netId, $user_id, $db, $isAdmin) {

    // $isAdmin = authenticateForRole($user_id, $db);
    // Inventory group routes
    $app->group('/inventory', function () use ($app, $twig, $db, $netId, $isAdmin) {

        //delete item form
        $app->post('/delete/item/:id', function ($id) use ($app, $twig, $db, $netId)  {  
            require_once('controllers/inventory/delete-item.php');
            $app->response->redirect('/admin-dashboard');
        });

        //create item form
        $app->get('/create/item', function () use ($app, $twig, $db, $netId) {
            echo $twig->render('admin/create-inventory-item.html', array('app' => $app, 'netId' => $netId));

        });

        //post created item
        $app->post('/create/item', function () use ($app, $twig, $db) {
            require_once('controllers/inventory/create-inventory-item.php');
            $id = $db->lastInsertId(); 
            $app->response->redirect('/inventory/view/item/' . $id);
        });
        // Get item with ID
        $app->get('/view/item/:id', function ($id) use ($app, $twig, $netId, $db) {
            require_once('controllers/inventory/update-inventory-item.php');
            echo $twig->render('inventory/inventory-item.html', array('app' => $app, 'id' => $id, 'netId' => $netId));
            
        })->setName('item');

        //get update item form
       $app->get('/update/item/:id', function ($id) use ($app, $twig, $db) {
            require_once('controllers/inventory/display-item.php');
            echo $twig->render('admin/create-inventory-item.html', array('app' => $app, 'individualItem' => $individualItem,
            'product_id' => $id, 'updating'=> true));
       });

       // Update item with ID
       $app->post('/update/item/:id', function ($id) use ($app, $twig, $db) {
            require_once('controllers/inventory/update-inventory-item.php');
            $app->response->redirect('/inventory/view/item/' . $id );
       });    
       
        //delete item form
    $app->post('/filter', function () use ($app, $twig, $db, $netId, $isAdmin)  {  
        require_once('controllers/inventory/search-items.php');
        echo $twig->render('inventory/listings.html', array('app' => $app, 'filterItems' => $searchItems, 'userEntry' => $item_name,
            'filter'=> true, 'isAdmin'=> $isAdmin));
        
    });
    });

   

     //base list all inventory items for ADMIN
     $app->get('/', function () use ($app, $twig, $netId, $user_id, $db, $isAdmin) {
            require_once('controllers/cart/list-items-in-cart.php');
            require_once('controllers/inventory/list-inventory-items.php');
            echo $twig->render('inventory/listings.html', array('app' => $app, 'netId' => $netId, 
            'items' => $items, 'cartItems' => $cartItems, 'isAdmin' => $isAdmin));
    });
});
//Regular authenticated and guest user inventory group routes
$app->group('/inventory', function () use ($app, $twig, $netId, $user_id, $db, $isAdmin) {

     // View item with ID
     $app->get('/view/item/:id', function ($id) use ($app, $twig, $user_id, $netId,$isAdmin, $db) {
        require_once('controllers/cart/list-items-in-cart.php');
        require_once('controllers/inventory/display-item.php');
        echo $twig->render('inventory/inventory-item.html', array('app' => $app, 'netId' => $netId,  
        'individualItem' => $individualItem, 'cartItems' => $cartItems, 'isAdmin' => $isAdmin));
    });


    //Base listings page
    $app->get('/', function () use ($app, $twig, $netId, $user_id,$isAdmin, $db ) {
        require_once('controllers/cart/list-items-in-cart.php');
        require_once('controllers/inventory/list-inventory-items.php');
        echo $twig->render('inventory/listings.html', array('app' => $app, 'netId' => $netId, 
        'items' => $items, 'cartItems' => $cartItems, 'isAdmin'=> $isAdmin));
        
    });

});

//Regular authenticated user cart group routes (guests will have to auth if they want to add items to cart)
$app->group('/cart', $authenticated($netId), function () use ($app, $twig, $user_id, $db) {

    //Add item to cart
    $app->post('/add/item/:id', function ($id) use ($app, $twig, $user_id, $db) {
        require_once('controllers/cart/add-item-to-cart.php');

    });

    // Update item in cart
    $app->put('/update/cart/item/:id', function ($id) {

    });

    // Delete item in cart
    $app->post('/delete/cart/item/:id/:amount', function ($id, $amount) use ($app, $twig, $user_id, $db) {
        require_once('controllers/cart/delete-items-from-cart.php');
        $app->response->redirect('/inventory');

    });
 //Add item to cart
 $app->get('/', function () use ($app, $twig) {
    echo $twig->render('admin/create-inventory-item.html', array('app' => $app));
    });
});


$app->get('/checkout', function () use ($app, $twig,$db, $user_id) {
    $query = "DELETE FROM cart_items WHERE id = $user_id";
    $db->query($query);
    echo $twig->render('checkout.html', array('app' => $app));

    });


?>