<?php

require_once 'vendor/phpmailer/phpmailer/src/Exception.php';
require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

abstract class AbstractController
{
    private \Twig\Environment $twig;
    
    private PHPMailer $mail;
    
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader,[
            'debug' => true,
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());
        
        $twig->addGlobal('csrf_token', $_SESSION["csrf-token"]);
        
        $this->twig = $twig;
        
    }
    
    
    protected function render(string $template, array $data) : void
    {
        echo $this->twig->render($template, $data); 
    }
    protected function redirect(string $route) : void
    {
        header("Location: $route");
    }

    // protected function renderJson(array $data) : void
    // {
    //     header('Content-Type: application/json');
    //     echo json_encode($data);
    //     exit;
    // }
    protected function renderJson(string $template, array $data) : void
    {
        $jsonData = json_encode($data);
        echo $this->twig->render($template, ['json_data' => $jsonData]);
    }
    
    protected function sendEmail(string $email,string $name) : bool
        {
            $mail = new PHPMailer(true);
            
            try {          
            $mail->SMTPDebug = SMTP::DEBUG_OFF;   
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 587;
            $mail->SMTPAuth   = true;
            $mail->Username   = 'portededamas5@gmail.com'; 
            $mail->Password   = 'efffgtusgfyziijb';
            
                
            $mail->CharSet    = "utf-8";
            
            $mail->addAddress($email, $name);
            $mail->setFrom('portededamas5@gmail.com', 'portededamas');
            
            $mail->isHTML(true);
            
            $mail->Subject = 'Confirmation de réservation';
            $mail->Body    = "Bonjour $name,<br><br>Votre réservation a été confirmée.<br><br>Merci de votre réservation.";
            $mail->send();
        
                return true;
            } catch (Exception) {
                return false;
            }
        }
    }



