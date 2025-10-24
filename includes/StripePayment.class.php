<?php

require 'vendor/autoload.php';

use Stripe\Stripe;
use Stripe\Checkout\Session;
class StripePayment{
    public function __construct($client_secret){
        Stripe::setApiKey($client_secret);
        Stripe::setApiVersion("2023-10-16");
    }
    public function startPayment($total, $quantity){
        $session = Session::create([
            'mode'=>'payment',
            'line_items' => [[
                'price_data' => [
                  'currency' => 'usd',
                  'product_data' => [
                    'name' => 'Produit',
                  ],
                  'unit_amount' => $total*100, // Montant en cents (USD)
                ],
                'quantity'=> $quantity
              ]],
            'success_url'=>'http://localhost/honicove-1/success.php?stripe',
            'cancel_url'=>'http://localhost/honicove-1/?payment_canceled',
            
        ]);

        // header('HTTP/1.1 See Other');
        // header('Location:'.$session->url);
        return $session;
    }
}


?>