<?php 
session_start();

//landing page
$app->get('/', function () use ($app, $twig) {
    echo $twig->render('home.html', array('app' => $app));

})->setName('home');

//Inventory listing page
$app->get('/listings', function () use ($app, $twig) {
    echo $twig->render('listings.html', array('app' => $app));

})->setName('home');
?>