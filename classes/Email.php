<?php

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
    //Server settings
    $mail = new PHPMailer;
    $mail->SMTPDebug = 0;                   
    $mail->isSMTP();                                    
    $mail->Host   = 'smtp.gmail.com';                 
    $mail->SMTPAuth   = true;                               
    $mail->Username   = 'tadeo.alvarez.regalado@gmail.com';              
    $mail->Password   = 'regalado0303';               
    $mail->SMTPSecure = 'tls';      
    $mail->Port       = 587;                   

    //Recipients
    $mail->setFrom('tadeo.alvarez.regalado@gmail.com', 'Red Social');
    $mail->addAddress($this->email, $this->nombre);  

    //Content
    $mail->isHTML(true);               
    $mail->CharSet = "UTF-8";       
    $mail->Subject = 'Confirma tu cuenta';
    $contenido = "<html>";
    $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en Red Social, solo debes confirmarla presionando el siguiente enlace</p>";
    $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/confirmar-cuenta?token=". $this->token . "'>Confirmar Cuenta</a></p>";
    $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
    $contenido .= "</html>";
    $mail->Body    = $contenido;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    if($mail->send()) {
        return true;
    } else {
        return false;
     }
    }

    public function enviarConfirmacionContraseña() {
        //Server settings
        $mail = new PHPMailer;
        $mail->SMTPDebug = 0;                   
        $mail->isSMTP();                                    
        $mail->Host   = 'smtp.gmail.com';                 
        $mail->SMTPAuth   = true;                               
        $mail->Username   = 'tadeo.alvarez.regalado@gmail.com';              
        $mail->Password   = 'regalado0303';               
        $mail->SMTPSecure = 'tls';      
        $mail->Port       = 587;                   
    
        //Recipients
        $mail->setFrom('tadeo.alvarez.regalado@gmail.com', 'Red Social');
        $mail->addAddress($this->email, $this->nombre);  
    
        //Content
        $mail->isHTML(true);               
        $mail->CharSet = "UTF-8";       
        $mail->Subject = 'Restablecer Contraseña';
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado cambiar tu contraseña, para hacerlo presiona el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/recuperar?token=". $this->token . "'>Restablecer Contraseña</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body    = $contenido;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if($mail->send()) {
            return true;
        } else {
            return false;
         }
        }
}