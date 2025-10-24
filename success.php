<?php
require 'vendor/autoload.php';


if(isset($_GET['stripe'])) {

    header('Location: http://localhost/cozastore-php/index.php?payment_successful=true&c=0');
    // var_dump($result);
    exit;

} 
?>