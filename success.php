<?php
include 'load.php';
require 'vendor/autoload.php';


if(isset($_GET['stripe'])) {

    header('Location: http://localhost/cozastore-php/thank-you.php');
    // var_dump($result);
    exit;

}
?>