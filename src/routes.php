<?php 
session_start();

//home page
$app->get('/', function () use ($app, $twig) {
    echo $twig->render('home.html', array('app' => $app));

})->setName('home');

//
// group routes for admin
$app->group('/admin-dashboard', function () use ($app, $twig) {
    
    // inventory group
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

        //base list all inventory items
        $app->get('/', function () use ($app, $twig) {
            echo $twig->render('inventory/listings.html', array('app' => $app));
        });

    });

    //base dashboard
    $app->get('/', function () use ($app, $twig) {
        echo $twig->render('admin/admin-dashboard.html', array('app' => $app));
    });

});

?>