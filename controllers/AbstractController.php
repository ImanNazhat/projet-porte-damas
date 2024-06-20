<?php

// Include necessary PHPMailer classes
require_once 'vendor/phpmailer/phpmailer/src/Exception.php';
require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';

// Use PHPMailer namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

abstract class AbstractController
{
    private \Twig\Environment $twig;
    private PHPMailer $mail;
    
    // Constructor method
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates'); // Set up Twig template loader
        
        // Initialize Twig environment with debugging enabled
        $twig = new \Twig\Environment($loader,[
            'debug' => true,
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());// Add debugging extension to Twig
        
        $twig->addGlobal('csrf_token', $_SESSION["csrf-token"]);// Add a global CSRF token to Twig
        
        
        $this->twig = $twig;// Assign Twig environment to the class property
    }
    
    // Method to render a Twig template
    protected function render(string $template, array $data) : void
    {
        echo $this->twig->render($template, $data); // Output the rendered template
    }

    // Method to redirect to a different route
    protected function redirect(string $route) : void
    {
        header("Location: $route");// Send a header to redirect to the specified route
    }

    // Protected method to send a JSON response
    protected function renderJson(array $data) : void
    {   
        // Set the Content-Type header to indicate the response is JSON
        header('Content-Type: application/json');
        // Encode the data array to JSON and output it
        echo json_encode($data);
        
    }
    
    // Method to send an email
    protected function sendEmail(string $email, string $name) : bool
    {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);
        
        try {
            // Set up SMTP debugging
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            
            // Set up SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 587;
            $mail->SMTPAuth   = true;
            $mail->Username   = 'portededamas5@gmail.com'; 
            $mail->Password   = 'efffgtusgfyziijb';
            
            // Set character encoding to UTF-8
            $mail->CharSet    = "utf-8";
            
            // Add recipient
            $mail->addAddress($email, $name);
            
            // Set the sender
            $mail->setFrom('portededamas5@gmail.com', 'portededamas');
            
            // Enable HTML in the email body
            $mail->isHTML(true);
            
            // Set email subject and body
            $mail->Subject = 'Confirmation de réservation';
            $mail->Body = "Bonjour $name,<br><br>
                            Votre réservation pour <strong> $nombrePersonnes personne/s </strong> le <strong> $date </strong> à <strong> $heure </strong> a été confirmée avec succès.<br><br>  
                            Merci pour votre réservation.";
            // Send the email
            $mail->send();
            
            return true;
        } catch (Exception) {
            return false;
        }
    }
}



