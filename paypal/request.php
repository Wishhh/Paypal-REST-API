<?php

require 'Authentication.php';

$data = json_encode(
    array (
        "intent" => "CAPTURE",
        "purchase_units" => array (
            array(
                "amount" => array (
                    "currency_code" => "USD",
                    "value" => "10.00"
                )
            )
        ),
        "application_context" => array(
            "return_url" => $paypalConfig['return_url'],
            "cancel_url" => $paypalConfig['cancel_url']
        )
    )
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v2/checkout/orders");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$json->access_token));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$json = json_decode($result);
$location = $json->links[1]->href;

header('Location: '.$location);

curl_close($ch);

?>