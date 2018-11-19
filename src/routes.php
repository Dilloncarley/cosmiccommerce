<?php 
session_start();

//landing page
$app->get('/', function () use ($app, $twig) {
    echo $twig->render('home.html', array('app' => $app));

})->setName('home');

//login
$app->get('/login', function() use ($app, $twig) {
    //auth through CAS system
    require_once('auth/inc/CAS/1.3.5/casAuth.php');

  
});

//logout
$app->get('/logout', function() use ($app, $twig) {
    $_SESSION['phpCAS']['user'] = null;
    $req = $app->request;

    //Get root URI
    $rootUri = $req->getRootUri();
    $app->response->redirect( $rootUri );

});

// ADMIN GROUP ROUTES
$app->group('/admin-dashboard', function () use ($app, $twig) {
    
    // Inventory group routes
    $app->group('/inventory', function () use ($app, $twig) {

        //create item
        $app->get('/create/item', function () use ($app, $twig) {
            echo $twig->render('admin/create-inventory-item.html', array('app' => $app));
        });
        // Get item with ID
        $app->get('/view/item/:id', function ($id) use ($app, $twig) {
            echo $twig->render('inventory/inventory-item.html', array('app' => $app, 'id' => $id));
        });

        // Update item with ID
        $app->put('/update/item/:id', function ($id) {

        });

        // Delete item with ID
        $app->delete('/delete/item/:id', function ($id) {

        });

        //base list all inventory items for ADMIN
        $app->get('/', function () use ($app, $twig) {
            echo $twig->render('inventory/listings.html', array('app' => $app));
        });

    });

    //base ADMIN dashboard
    $app->get('/', function () use ($app, $twig) {
        echo $twig->render('admin/admin-dashboard.html', array('app' => $app));
    });

});

//Regular authenticated and guest user inventory group routes
$app->group('/inventory', function () use ($app, $twig) {

   
     // View item with ID
     $app->get('/view/item/:id', function ($id) use ($app, $twig) {
        echo $twig->render('inventory/inventory-item.html', array('app' => $app));
    });

    //Base listings page
    $app->get('/', function () use ($app, $twig) {
        echo $twig->render('inventory/listings.html', array('app' => $app));
    });

});

//Regular authenticated user cart group routes (guests will have to auth if they want to add items to cart)
$app->group('/cart', function () use ($app, $twig) {

    //Add item to cart
    $app->post('/add/cart/item', function () use ($app, $twig) {
    echo $twig->render('admin/create-inventory-item.html', array('app' => $app));
    });

    // Update item in cart
    $app->put('/update/cart/item/:id', function ($id) {

    });

    // Delete item in cart
    $app->delete('/delete/cart/item/:id', function ($id) {

    });

});





?>