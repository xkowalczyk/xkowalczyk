<?php

namespace App\Libraries\Services;

class EmailService{

    private $email;

    public function __construct()
    {
        $this->email = \Config\Services::email();
    }

    public function sendActiveAccountEmail($userEmail, $userName)
    {
        $message = "
            Cześć! {$userName} cieszymy się że założyłeś konto w naszym sklepie. Aktywuj email klikając w link: http://xkowalczyk.pl/api/activate/{$userEmail}
        ";
        $this->email->setFrom('xkowalczyk.pl', 'xkowalczyk');
        $this->email->setTo($userEmail);
        $this->email->setSubject('Aktywacja konta');
        $this->email->setMessage($message);
        $this->email->send();
    }

    public function sendOrderConfirm($userEmail, $userName, $orderPrice, $orderId)
    {
        $message = "
            Cześć! {$userName} cieszymy się że założyłeś zamówienie na kwotę {$orderPrice}. Status zamówienia możesz sprawdzić klikając w link: http://xkowalczyk.pl/account/checkorder/{$orderId}
        ";
        $this->email->setFrom('xkowalczyk.pl', 'xkowalczyk');
        $this->email->setTo($userEmail);
        $this->email->setSubject('Potwierdzenie zamówienia: '.$orderId);
        $this->email->setMessage($message);
        $this->email->send();
    }

    public function sendConfirmAccountEmail($userEmail, $userName)
    {
        $message = "
            Cześć! {$userName} cieszymy się że potwierdziłeś konto. Zarządzanie kontem klikając w link: http://xkowalczyk.pl/account
        ";
        $this->email->setFrom('xkowalczyk.pl', 'xkowalczyk');
        $this->email->setTo($userEmail);
        $this->email->setSubject('Aktywacja konta');
        $this->email->setMessage($message);
        $this->email->send();
    }
}