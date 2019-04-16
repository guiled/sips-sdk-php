<?php
require 'vendor/autoload.php';

class dummy extends Worldline\Sips\SipsRequest {
    function toArray(): array
    {
        return json_decode(<<<JSON
       {
  "amount": "2500",
  "captureDay": "0",
  "captureMode": "AUTHOR_CAPTURE",
  "cardCSCValue": "0000",
  "cardExpiryDate": "201612",
  "cardNumber": "1234123412341234",
  "currencyCode": "978",
  "interfaceVersion": " IR_WS_2.3",
  "keyVersion": "1",
  "merchantId": "011223344550000",
  "orderChannel": "INTERNET",
  "orderId": " ORD101",
  "returnContext": " ReturnContext",
  "transactionOrigin": " SO_WEBAPPLI",
  "transactionReference": "TREFEXA2012",
  "seal": "2205f0636dc500c4f3ef536075895b8baba3a60c7087e06cd9d330c50a50c53e"
}

    

JSON
, true            );

    }

    function setSeal(string $seal)
    {
        var_dump($seal);
        parent::setSeal($seal);
    }
}


$sipsRequest = new dummy;
$secretKeys = [
    'secret123',
    'YourSecretKey'
];

$sealCalculator = new Worldline\Sips\Common\Seal\JsonSealCalculator();

foreach ($secretKeys as $secretKey) {
    $sealCalculator->calculateSeal($sipsRequest, $secretKey);
}

