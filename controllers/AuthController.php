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
                                
                                if (empty($name) || empty($email) || empty($telephone) || empty($nombrePersonnes) || empty($date) || empty($heure) || empty($message)) {
                                    $_SESSION["error-message"] = "Tous les champs sont obligatoires. Veuillez les remplir.";
                                    $this->render("main/reserver.html.twig", ['error' => $_SESSION["error-message"]]);
                                    unset($_SESSION["error-message"]);
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
                
           public function checkConnexion(): void
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $this->renderJson(['error' => "Le formulaire n'est pas soumis par la méthode POST"]);
            return;
        }

        if (empty($_POST["email"]) || empty($_POST["password"])) {
            $this->renderJson(["error" => "Veuillez renseigner tous les champs"]);
            return;
        }

        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf-token"]) || !$tokenManager->validateCSRFToken($_POST["csrf-token"])) {
            $this->renderJson(["error" => "Jeton CSRF invalide"]);
            return;
        }

        $usermanager = new UserManager();
        $user = $usermanager->findByEmail($_POST["email"]);

        if ($user === null) {
            $this->renderJson(["error" => "Email incorrect. Veuillez réessayer."]);
            return;
        }

        if (!password_verify($_POST["password"], $user->getPassword())) {
            $this->renderJson(["error" => "Mot de passe incorrect. Veuillez réessayer."]);
            return;
        }

        $_SESSION["user"] = $user->getId();
        unset($_SESSION["error-message"]);
        // $this->renderJson(["success" => true, "redirect" => "base-admin.html.twig"]);
        $this->renderJson("base-admin.html.twig", ["success" => true]);
    }

                    public function logout() : void
                    {
                        
                        session_destroy();
                        
                        $this->render("main/connexion.html.twig", ['message' => 'Vous avez été déconnecté avec succès.']);
                        
                    }
}
                
            
                                   