<?php

$paypalConfig = [
    'client_id' => 'AfXuYdOKIKwXLI03pqGKCbS2QPAH13oTdeuWE1rzHCBak10kIT7xAnBDP35hMYWfyH8UZ5jRqFUdRaux',
    'client_secret' => 'EOdxHQNAQeFfm-Xq2RlK9S0xUt2P_U9yVIp1iN2fxjhCx78JpAnaepxpGb_j3pMeC8iSyuiZbz6a0wKa',
    'return_url' => 'http://localhost/PayPalApi/paypal/response.php',
    'cancel_url' => 'http://localhost/PayPalApi/payment-cancelled.html'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $paypalConfig['client_id'].":".$paypalConfig['client_secret']);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
$result = curl_exec($ch);

if(empty($result))die("Error: No response.");
else
{
    $json = json_decode($result);
    var_dump( $json->access_token);
}
curl_close($ch);

?>