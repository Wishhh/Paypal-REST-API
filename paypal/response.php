<?php
require 'Authentication.php';
require '../db_connection.php';

if (empty($_GET['token']) || empty($_GET['PayerID'])) {
    throw new Exception('The response is missing the paymentId and PayerID');
}

$paymentId = $_GET['token'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v2/checkout/orders/$paymentId/capture");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$json->access_token));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);

if(empty($result))die("Error: No response.");
else{
    $json = json_decode($result);
}

    try {
        $db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['name']);

        $data = [
            'product_id' => $json->id,
            'transaction_id' => $json->id,
            'payment_amount' => $json->purchase_units[0]->payments->captures[0]->amount->value,
            'currency_code' => $json->purchase_units[0]->payments->captures[0]->amount->currency_code,
            'payment_status' => $json->status,
            'invoice_id' => $json->status,
            'product_name' => $json->status,
        ];

        if (addPayment($data) !== false && $data['payment_status'] === 'COMPLETED') {
            $inserids =$db->insert_id;
            header("location:http://localhost/PayPalApi/PaypalSuccess.php?payid=".$inserids);
            exit();
        } else {
			header("location:http://localhost/PayPalApi/payment-cancelled.php");
            exit();
        }

    } catch (Exception $e) {
        // Failed to retrieve payment from PayPal
    }


/**
 * Add payment to database
 *
 * @param array $data Payment data
 * @return int|bool ID of new payment or false if failed
 */
function addPayment($data)
{
    global $db;

    if (is_array($data)) {
		//isdsssss
        $stmt = $db->prepare('INSERT INTO `payments` (product_id,transaction_id, payment_amount,currency_code, payment_status, invoice_id, product_name, createdtime) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param(
            'ssdsssss',
            $data['product_id'],
            $data['transaction_id'],
            $data['payment_amount'],
            $data['currency_code'],
            $data['payment_status'],
            $data['invoice_id'],
            $data['product_name'],
            date('Y-m-d H:i:s')
        );
        $stmt->execute();
        $stmt->close();
		
        return $db->insert_id;
    }

    return false;
}
