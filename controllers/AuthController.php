<?php

// Declaration of the AuthController class extending AbstractController
class AuthController extends AbstractController
                {
                    public function Reservation() : void
                    {
                     $this->render("main/reserver.html.twig", []);
                    }
                    
                    public function createReservation() : void{
                         
                        $this->render("main/reserver.html.twig" , []);
                    }
                    
                    // Method to check and create a reservation
                    public function checkCreateReservation() : void{
                      
                     // Check if all required fields are set in $_POST
                         if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["telephone"]) && isset($_POST["nombre_personnes"]) && isset($_POST["date"]) && isset($_POST["heure"]) && isset($_POST["message"]))
                            {
                                 // Retrieve the form field values
                                $name = $_POST["name"];
                                $email = $_POST["email"];
                                $telephone = $_POST["telephone"];
                                $nombrePersonnes = $_POST["nombre_personnes"];
                                $date = $_POST["date"];
                                $heure = $_POST["heure"];
                                $message = $_POST["message"];
                                
                                // Check if any of the fields are empty
                                if (empty($name) || empty($email) || empty($telephone) || empty($nombrePersonnes) || empty($date) || empty($heure)) {
                                    
                                    // Set an error message in the session
                                    $_SESSION["error-message-o"] = "Tous les champs sont obligatoires. Veuillez les remplir.";
                                     // Render the page with the error message
                                    $this->render("main/reserver.html.twig", ['error' => $_SESSION["error-message-o"]]);
                                    unset($_SESSION["error-message-o"]);
                                    return;
                                }
                                
                                // Create a new Reservation object with the form data
                                $reservation = new Reservation($name, $email, $telephone, $nombrePersonnes, $date, $heure, $message);
                                
                                $reservationManager = new ReservationManager();
                                
                                // Create the reservation in the database
                                $createdReservation = $reservationManager->createReservation($reservation);
                                
                                // Send a confirmation email
                                $this->sendEmail($email,$name);
                                
                                // Render the reservation page after creation
                                $this->render("main/reserver.html.twig" , []);    
                            }       
         }
               
                     public function connexion(): void
                        {
                           $this->render("main/connexion.html.twig", []);
                         }
                
                     
                    public function checkConnexion() : void
                    {
                        if($_SERVER["REQUEST_METHOD"] === "POST") {
                            
                        if (isset($_POST["email"]) && isset($_POST["password"])) {
                            
                            // CSRF token manager to validate the token
                            $tokenManager = new CSRFTokenManager();
                            
                            if (isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"])) {
                                
                                $usermanager = new UserManager();
                                
                                $user = $usermanager->findByEmail($_POST["email"]);
                                
                                if ($user !== null) {
                                    
                                    if (password_verify($_POST["password"], $user->getPassword())) {
                                        
                                        // Set the user ID in the session
                                        $_SESSION["user"] = $user->getId();
                                        
                                        unset($_SESSION["error-message"]);
                                        
                                        // Render a JSON response with success
                                        $this->renderJson(['success' => true, 'redirect' => 'base-admin.html.twig']);
                                        
                                        return;
                                    } 
                                    else {
                                        
                                        // Render a JSON response with incorrect password error
                                        $this->renderJson(['success' => false, 'error' => 'Mot de passe incorrect. Veuillez réessayer.']);
                                        return;
                                    }
                                }
                                
                            else {
                                    $this->renderJson(['success' => false, 'error' => 'Email incorrect. Veuillez Réessayer.']);
                                    return;
                                }
                            }
                        else {
                                $this->renderJson(['success' => false, 'error' => 'Token CSRF invalide. Veuillez réessayer.']);
                                return;
                            }
                        }
                    else {
                            // Render a JSON response with fields not filled error
                            $this->renderJson(['success' => false, 'error' => 'Veuillez remplir tous les champs.']);
                            return;
                        }
                    }
                    }
                    
                    public function logout() : void
                    {
                        
                        session_destroy();
                        
                        $this->render("main/connexion.html.twig", ['message' => 'Vous avez été déconnecté avec succès.']);
                        
                    }
}
                
            
                                   