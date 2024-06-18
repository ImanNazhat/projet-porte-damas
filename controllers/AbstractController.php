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

    // Method to render JSON data using Twig
    protected function renderJson(string $template, array $data) : void
    {
        $jsonData = json_encode($data);// Encode the data array to JSON

        echo $this->twig->render($template, ['json_data' => $jsonData]);  // Render the template with the JSON data
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
            $mail->Body    = "Bonjour $name,<br><br>Votre réservation a été confirmée.<br><br>Merci de votre réservation.";
            
            // Send the email
            $mail->send();
            
            return true;
        } catch (Exception) {
            return false;
        }
    }
}



