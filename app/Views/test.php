<?php
$FORMULARZ = [
"SEKRET" => "NEl6Z1A1VHJmRjBSZ2xraU04ajd2V2Y4TElZSDlwSHJQd3Z5NkxVekk4Yz0,",
"KWOTA" => "100",
"NAZWA_USLUGI" => "TEST",
"ADRES_WWW" => "http://xkowalczyk.pl/api/payment",
"ID_ZAMOWIENIA" => "1",
"EMAIL" => "",
"DANE_OSOBOWE" => "",
"TYP" => "INIT",
];

$FORMULARZ["HASH"]=hash("sha256", "TKfqVda3" . ";" . $FORMULARZ["KWOTA"] . ";" . $FORMULARZ["NAZWA_USLUGI"] . ";" . $FORMULARZ["ADRES_WWW"] . ";" . $FORMULARZ["ID_ZAMOWIENIA"] . ";" . $FORMULARZ["SEKRET"]);
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://platnosc.hotpay.pl/");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$FORMULARZ);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);
if(!empty($server_output)){
$JSON=json_decode($server_output,true);
if(!empty($JSON["STATUS"])){
if($JSON["STATUS"] == true){
echo '<a href="'.$JSON["URL"].'">Zapłać</a>';
}else{
// BŁĄD
echo $JSON["WIADOMOSC"];
}
}
}