<?php 
session_start();
$netId = "";
if($_SERVER['SERVER_NAME'] == "pluto.cse.msstate.edu"){
    $netId = $_SESSION['phpCAS']['user'];
    $user_id = $_SESSION['phpCAS']['user_id'];
} else {
    $_SESSION['phpCAS']['user'] =  "abc123";
    $_SESSION['phpCAS']['user_id'] = 1;
    $netId = $_SESSION['phpCAS']['user'];
    $user_id = $_SESSION['phpCAS']['user_id'];
}
$userIsAdmin = true;
//checks if user is logged in and fills the correct admin role
$authenticateForRole = function ($user_id, $db) {
    return function () use ($user_id, $db) {
        $query = "SELECT isAdmin FROM users WHERE id = $user_id";
        $userIsAdmin= $db->query($query)->fetchColumn();
        if (!$userIsAdmin) {
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

// ADMIN GROUP ROUTES
$app->group('/admin-dashboard', $authenticated($netId), $authenticateForRole($user_id, $db), function () use ($app, $twig, $netId, $db) {
    
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
$app->group('/inventory', function () use ($app, $twig, $netId, $db) {

   
     // View item with ID
     $app->get('/view/item/:id', function ($id) use ($app, $twig, $netId, $db) {
        echo $twig->render('inventory/inventory-item.html', array('app' => $app, 'netId' => $netId));
    });

    //Base listings page
    $app->get('/', function () use ($app, $twig, $netId, $db) {
        require_once('controllers/inventory/list-inventory-items.php');
    });

});

//Regular authenticated user cart group routes (guests will have to auth if they want to add items to cart)
$app->group('/cart', $authenticated($netId), function () use ($app, $twig, $netId, $db) {

    //Add item to cart
    $app->post('/add/item/:id', function ($id) use ($app, $twig, $db) {
        require_once('controllers/cart/add-item-to-cart.php');

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