<?php 
session_start();

//home page
$app->get('/', function () use ($app, $twig) {
    echo $twig->render('home.html', array('app' => $app));

})->setName('home');
?>