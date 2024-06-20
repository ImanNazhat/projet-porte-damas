<?php


class AuthController extends AbstractController
                {
                    public function Reservation() : void
                    {
                     $this->render("main/reserver.html.twig", []);
                    }
                    
                    public function createReservation() : void{
                         
                        $this->render("main/reserver.html.twig" , []);
                    }
                    
                      public function checkCreateReservation() : void{
                      
                     
                         if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["telephone"]) && isset($_POST["nombre_personnes"]) && isset($_POST["date"]) && isset($_POST["heure"]) && isset($_POST["message"]))
                            {
                                $name = $_POST["name"];
                                $email = $_POST["email"];
                                $telephone = $_POST["telephone"];
                                $nombrePersonnes = $_POST["nombre_personnes"];
                                $date = $_POST["date"];
                                $heure = $_POST["heure"];
                                $message = $_POST["message"];
                                
                                if (empty($name) || empty($email) || empty($telephone) || empty($nombrePersonnes) || empty($date) || empty($heure)) {
                                    $_SESSION["error-message-o"] = "Tous les champs sont obligatoires. Veuillez les remplir.";
                                    $this->render("main/reserver.html.twig", ['error' => $_SESSION["error-message-o"]]);
                                    unset($_SESSION["error-message-o"]);
                                    return;
                                }

                                $reservation = new Reservation($name, $email, $telephone, $nombrePersonnes, $date, $heure, $message);
                                
                                $reservationManager = new ReservationManager();
                                
                                $createdReservation = $reservationManager->createReservation($reservation);
                                
                                $this->sendEmail($email,$name);
                                
                                $this->render("main/reserver.html.twig" , []);
                                
                            }
                 
         }
               
                   public function connexion(): void
                                {
                                    $this->render("main/connexion.html.twig", []);
                                }
                
                //   public function checkConnexion() : void
                //             {
                //                 if(isset($_POST["email"]) && isset($_POST["password"]))
                //                 {
                //                      $tokenManager = new CSRFTokenManager();
                                     
                //                 if(isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"]))
                //                 {
                                    
                //                     $usermanager = new UserManager();
                //                     $user = $usermanager->findByEmail($_POST["email"]);
                                    
                                    
                //                     if($user !== null)
                //                     {
                //                         if(($_POST["password"] === $user->getPassword()))
                //                         {
                                            
                //                             $_SESSION["user"] = $user->getId();
                                            
                //                             unset($_SESSION["error-message"]);
                                            
                //                             $this->render("base-admin.html.twig" , []);
                //                             return;
                //                         }
                //                         else
                //                         {
                //                             // invalid credentials (password)
                //                           $_SESSION["error-message"] = "Mot de pass incorrect. Veuillez réessayer.";
                //                          $this->render("main/connexion.html.twig", ['error' => $_SESSION["error-message"]]);
                //                          return;
                //                         }
                //                     }
                //                     else
                //                     {
                //                         // invalid credentials (email)
                //                           $_SESSION["error-message"] = "Email incorrect. Veuillez réessayer.";
                //                         $this->render("main/connexion.html.twig" , ['error' => $_SESSION["error-message"]]);
                //                         return;
                //                     }
                //                 }
                //                 else
                //                 {
                //                     // missing fields
                //                     $this->render("main/connexion.html.twig" , []);
                //                     return;
                //                 }
                //             }
                //                         }

public function checkConnexion() : void
{
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        
        $tokenManager = new CSRFTokenManager();
        
        if (isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"])) {
            
            $usermanager = new UserManager();
            
            $user = $usermanager->findByEmail($_POST["email"]);
            
            if ($user !== null) {
                
                if (password_verify($_POST["password"], $user->getPassword())) {
                    
                    $_SESSION["user"] = $user->getId();
                    
                    unset($_SESSION["error-message"]);
                    
                    $this->renderJson(['success' => true, 'redirect' => 'base-admin.html.twig']);
                    
                    return;
                } else {
                    $this->renderJson(['success' => false, 'error' => 'Mot de passe incorrect. Veuillez réessayer.']);
                    return;
                }
            } else {
                $this->renderJson(['success' => false, 'error' => 'Email incorrect. Veuillez Réessayer.']);
                return;
            }
        } else {
            $this->renderJson(['success' => false, 'error' => 'Token CSRF invalide. Veuillez réessayer.']);
            return;
        }
    } else {
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
                
            
                                   