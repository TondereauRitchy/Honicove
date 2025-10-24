<?php
require_once "includes/StripePayment.class.php";

$response = array('error'=>true);

$payment = new StripePayment('sk_test_51SLokyF8mYQGGK7EVohGhf7DuSsUzE6kC9TAbo5re5jyv8o1V9pu0GjLFRBVP9995H2KmwELfuIHb6oI5XaVgxdj00pezuUtFe');
// $payment->startPayment($_GET['total'], $_GET['quantity']);

if(isset($_GET['total']) && !empty($_GET['total']) && isset($_GET['quantity']) && !empty($_GET['quantity'])) {
    $session = $payment->startPayment($_GET['total'], $_GET['quantity']);

    // var_dump($payment);

    $response['error'] = false;
    $response['msg'] = "La requête de paiement a été effectuée, utiliser le redirect_url pour confirmer le paiement";
    $response['redirect_url'] = $session->url;

} else {
    $response['msg'] = "Le montant et/ou la quantite n'est pas spécifié";
}

echo json_encode($response);



?>