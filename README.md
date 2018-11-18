# cosmiccommerce
1. Run `git clone https://github.com/Dilloncarley/cosmiccommerce`
2. Run `cd cosmiccommerce`
3. Run `mkdir config`
4. Run `cd config`
5. Make a new file called `config.php` in that config folder with contents of 
```
<?php
$config_array = array(
    'debug' => true,
    'templates.path' => 'templates',
    'dbHost' => '',
    'dbUser' => '',
    'dbPass' => '',
    'dbName' => ''
);
?>
```
6. Ensure you have Composer Dependency manager and run `composer install`

# Run Local Server
Run `php -S localhost:8888 -t public public/index.php` to serve the site
