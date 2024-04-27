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
                                
                                $reservation = new Reservation($name, $email, $telephone, $nombrePersonnes, $date, $heure, $message);
                                
                                
                                
                                $reservationManager = new ReservationManager();
                                
                                $createdReservation = $reservationManager->createReservation($reservation);
                                
                                $this->redirect("index.php?route=Reserver");
                            }
                    }
                    
                    public function connexion() : void
                    {
                      $this->render("main/connexion.html.twig", []);
                    }
                    
                    public function checkConnexion() : void
                    {
                        if(isset($_POST["email"]) && isset($_POST["password"]))
                        {
                            $usermanager = new UserManager();
                            $user = $usermanager->findByEmail($_POST["email"]);
                
                            if($user !== null)
                            {
                                if(password_verify($_POST["password"], $user->getPassword()))
                                {
                                    
                                    $_SESSION["user"] = $user->getId();
                                    $this->redirect("index.php?route=admin-menu");
                                    return;
                                }
                                else
                                {
                                    // invalid credentials (password)
                                    $this->redirect("index.php?route=Votre-avis");
                                    return;
                                }
                            }
                            else
                            {
                                // invalid credentials (email)
                                $this->redirect("index.php?route=Reserver");
                               return;
                            }
                        }
                        else
                        {
                            // missing fields
                            $this->redirect("index.php?route=Connexion");
                            return;
                        }
                    }
                                }