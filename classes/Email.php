<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $name;
    public $token;

    public function __construct($email, $name, $token)
    {
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }

    public function sendConfirmation()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '0f0321750051f5';
        $mail->Password = 'c97752abab6671';

        $mail->setFrom("noreply@appsalon.com");
        $mail->addAddress($this->email, $this->name);

        //
        $html = "<html>";
        $html .= "<h1>Bienvenido a AppSalon!</h1>";
        $html .= "<p>Estimado <strong>$this->name</strong>, tómate un momento para confirmar que tu dirección de correo electrónico es correcta y te pertenece.</p>";
        $html .= "<p><a href='http://localhost:3000/email-confirmation?token=$this->token'>Verificar</a></p><br><br>";
        $html .= "Si usted no solicitó una cuenta en appsalon.com, ignore este mensaje.";
        $html .= "</html>";

        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";
        $mail->Subject = "Bienvenido a AppSalon!";
        $mail->Body = $html;

        $mail->send();
    }

    public function sendRecover()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '0f0321750051f5';
        $mail->Password = 'c97752abab6671';

        $mail->setFrom("noreply@appsalon.com");
        $mail->addAddress($this->email, $this->name);

        //
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";
        $mail->Subject = "[AppSalon] Reestablecer contraseña";

        $html = "<html>";
        $html .= "<h1>Estimado $this->name</h1>";
        $html .= "<p>Nos llegó un pedido para recuperar tu cuenta. Si no fuiste tú, puedes ingorar este mensaje. Si deseas reestablecer tu contraseña, sigue el siguiente enlace:</p>";
        $html .= "<p><a href='http://localhost:3000/password-reset?token=$this->token'>Reestablecer contraseña</a></p><br><br>";
        $html .= "</html>";
        $mail->Body = $html;

        $mail->send();
    }
}