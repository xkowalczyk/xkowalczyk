<?php
$domain = "secure";
$pos_id = "434469";
$poskey2 = "0f1d024de9a35c0be24e9c901acae6dd";
$currencyCode = "PLN";
$desc = "Płatność za zamówienie";
$email = $userEmail;
$amount = $totalPrice;
$pay_type = "";
$validityTime = 3600;
$customerIp = "127.0.0.1";
$date = date_create();
$timestamp = date_timestamp_get($date);

$tablica = array(
    "continueUrl" => "http://xkowalczyk.pl/payment/api",
    "notifyUrl" => "http://xkowalczyk.pl/payment/api",
    "products[0].name" => "Zakupy",
    "products[0].quantity" => "1",
    "products[0].unitPrice" => "1",
    "buyer.firstName" => "",
    "buyer.lastName" => "",
    "buyer.language" => "",
    "buyer.phone" => "",

    "buyer.email" => $email,
    "currencyCode" => $currencyCode,
    "customerIp" => $customerIp,
    "description" => $desc,
    "merchantPosId" => $pos_id,
    "totalAmount" => $amount,
    "validityTime" => $validityTime,
    "extOrderId" => $timestamp,
);
if ($pay_type !== "") {
    $tablica['payMethods.payMethod.type'] = "PBL";
    $tablica['payMethods.payMethod.value'] = $pay_type;
};
ksort($tablica);
$emptyRemoved = array_filter($tablica);
ksort($emptyRemoved);
$zmienna = '';
foreach ($emptyRemoved as $key => $value) {
    $zmienna = $zmienna . $key . "=" . urlencode($value) . "&";
}
$newsig = hash('sha256', $zmienna . $poskey2);
echo '
<form method="post" action="https://' . $domain . '.snd.payu.com/api/v2_1/orders">';
foreach ($emptyRemoved as $key => $value) {
    echo '
    <input type="hidden" name="' . $key . '"  value="' . $value . '">';
};
echo '
    <input type="hidden" name="OpenPayu-Signature" value="sender=' . $tablica["merchantPosId"] . ';algorithm=SHA-256;signature=' . $newsig . '">
    <button type="submit" formtarget="_self" >Zapłać</button>
</form >
';
