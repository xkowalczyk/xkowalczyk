<?php

namespace App\Libraries;

class PayForm
{
    public function generatePayForm($userEmail, $userName, $orderId, $orderTitle, $orderAmount)
    {
        $payFormParameters = [
            "SEKRET" => "NEl6Z1A1VHJmRjBSZ2xraU04ajd2V2Y4TElZSDlwSHJQd3Z5NkxVekk4Yz0,",
            "KWOTA" => $orderAmount,
            "NAZWA_USLUGI" => $orderTitle,
            "ADRES_WWW" => "http://xkowalczyk.pl/api/payment",
            "ID_ZAMOWIENIA" => (string)$orderId,
            "EMAIL" => (string)$userEmail,
            "DANE_OSOBOWE" => (string)$userName,
            "TYP" => "INIT",
        ];

        $payFormParameters["HASH"] = hash("sha256", "TKfqVda3" . ";" . $payFormParameters["KWOTA"] . ";" . $payFormParameters["NAZWA_USLUGI"] . ";" . $payFormParameters["ADRES_WWW"] . ";" . $payFormParameters["ID_ZAMOWIENIA"] . ";" . $payFormParameters["SEKRET"]);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://platnosc.hotpay.pl/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payFormParameters);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        if (!empty($server_output)) {
            $JSON = json_decode($server_output, true);
            if (!empty($JSON["STATUS"])) {
                if ($JSON["STATUS"] == true) {
                    echo '<a target="_blank" href="' . $JSON["URL"] . '">Przejdź do płatności</a>';
                } else {
                    // BŁĄD
                    echo $JSON["WIADOMOSC"];
                }
            }
        }
    }
}
