# Cosmiccommerce
The main objective of this web application is to promote and display the sale of galactic real estate, products and spacecraft to our users. Authenticated users will be connected to our services for their galactic real estate and spacecraft desires. Non-authenticated users will be informed about our services on our landing page, but they will have to create a official account in order to browse through, purchase, or receive information about our products.  

Design Document: https://docs.google.com/document/d/1fmQcbOvF-N4DSXqrCmx3OCKg65uv77-IlhYmR4lEw0I/edit?usp=sharing

Software Requirements Document: https://docs.google.com/document/d/1GQneOJwRSSJUVFtG5V2XzLH0Ob6gCKqgnrKb6Nsf3NU/edit?usp=sharing

Final Report: https://docs.google.com/document/d/12Jsa5SXB0YZmwRiTmqs8L6WMerD9sXdjiLj1XOlzY_M/edit?usp=sharing

#Installation
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
