<?php 
//home page
$app->get('/test', function () use ($app, $twig) {
    echo $twig->render('home.html', array('name' => 'Fabien'));

});
$app->get('/dogs', function () use ($app, $twig) {
    echo $twig->render('home.html', array('name' => 'Fabien'));

});
?>