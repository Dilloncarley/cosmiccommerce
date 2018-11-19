<?php
    // CAS authentication 
    include_once('../cosmiccommerce/inc/CAS/1.3.5/casAuth.php');

    $req = $app->request;
    //Get root URI
    $rootUri = $req->getRootUri();
    
    if(isset($_SESSION['phpCAS']['user'])){
         header("Location: ". $rootUri . "/inventory");
         exit;
      } else {
         header("Location: ". $rootUri . "");
         exit;
      }
   
?>