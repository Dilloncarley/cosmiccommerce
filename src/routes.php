<?php 
session_start();
$_SESSION['phpCAS']['user'] = "dc1829"; 
$netId = $_SESSION['phpCAS']['user'];
$userIsAdmin = true;
//checks if user is logged in and fills the correct admin role
$authenticateForRole = function ( $isAdmin = true, $netId) {
    return function () use ( $isAdmin, $netId) {
        if (!$isAdmin || $netId == null) {
            $app = \Slim\Slim::getInstance();
            $app->response->redirect($app->urlFor('error', array('err' => 'Sorry, you do not have the right permissions to view this page')));

        }
    };
};
//checks if user is logged in
$authenticated = function($netId){
    return function () use ($netId) {
        if ($netId == null) {
            $app = \Slim\Slim::getInstance();
            $app->response->redirect('/login');
        }
    };
};
//landing page
$app->get('/', function () use ($app, $twig, $netId) {
    $allGetVars = $app->request->post();

    echo $twig->render('home.html', array('app' => $app, 'netId' => $netId));


})->setName('home');

$app->get('/404/:err', function($err) use ($app, $twig, $netId){
    echo $twig->render('404.html', array('app' => $app, 'netId' => $netId, 'error' => $err));

})->setName('error');

//login
$app->get('/login', function() use ($app, $twig) {

    //auth through CAS system
    echo $app->render('casSystem.php', array('app' => $app));
  
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
$app->group('/admin-dashboard', $authenticateForRole($userIsAdmin, $netId), function () use ($app, $twig, $netId, $db) {
    
    // Inventory group routes
    $app->group('/inventory', function () use ($app, $twig, $db, $netId) {

        //create item form
        $app->get('/create/item', function () use ($app, $twig, $db, $netId) {
            echo $twig->render('admin/create-inventory-item.html', array('app' => $app, 'netId' => $netId));

        });

        //post created item
        $app->post('/create/item', function () use ($app, $twig, $db) {
            require_once('controllers/create-inventory-item.php');
            echo $twig->render('admin/create-inventory-item.html', array('app' => $app));

        });
        // Get item with ID
        $app->get('/view/item/:id', function ($id) use ($app, $twig, $netId) {
            echo $twig->render('inventory/inventory-item.html', array('app' => $app, 'id' => $id, 'netId' => $netId));
        });

        // Update item with ID
        $app->put('/update/item/:id', function ($id) {

        });

        // Delete item with ID
        $app->delete('/delete/item/:id', function ($id) {

        }); 
    });
     //base list all inventory items for ADMIN
     $app->get('/', function () use ($app, $twig, $netId) {
        echo $twig->render('inventory/listings.html', array('app' => $app, 'netId' => $netId));
    });
});
//Regular authenticated and guest user inventory group routes
$app->group('/inventory', function () use ($app, $twig, $netId) {

   
     // View item with ID
     $app->get('/view/item/:id', function ($id) use ($app, $twig, $netId) {
        echo $twig->render('inventory/inventory-item.html', array('app' => $app, 'netId' => $netId));
    });

    //Base listings page
    $app->get('/', function () use ($app, $twig, $netId) {
        echo $twig->render('inventory/listings.html', array('app' => $app, 'netId' => $netId));
    });

});

//Regular authenticated user cart group routes (guests will have to auth if they want to add items to cart)
$app->group('/cart', $authenticated($netId), function () use ($app, $twig, $netId) {

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
 //Add item to cart
 $app->get('/', function () use ($app, $twig) {
    echo $twig->render('admin/create-inventory-item.html', array('app' => $app));
    });
});





?>