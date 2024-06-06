<?php

class AvisController extends AbstractController
                {   
                    public function Avis() : void
                    {
                        
                        $avis = new AvisManager;
                        
                        $aviss = $avis->findAll();
                        
                     $this->render("main/avis.html.twig", [
                         "aviss" => $aviss
                         ]);
                    }
                    
                     public function createAvis() : void{
                         
                        $this->render("main/avis.html.twig" , []);
                    }
                    
                    public function checkCreateAvis() : void {
                    // Vérification de la soumission du formulaire
                    if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["comment"])) {
                       
                        $username = htmlspecialchars(trim($_POST["username"]));
                        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
                        $comment = htmlspecialchars(trim($_POST["comment"]));
                        
                        if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($username) && !empty($comment)) {
                            
                            $avis = new Avis($username, $email, $comment);
                            
                            
                            $avisManager = new AvisManager();
                            
                           
                            $createdAvis = $avisManager->createAvis($avis);
                            
                          
                            $this->redirect("index.php?route=Votre-avis");
                        } else {
                            echo "Données invalides.";
                        }
                    }
                  }
                    
                    public function delete(int $avisId) : void{
                        
                        $avisManager = new AvisManager();
                        
                        $avisManager->delete($avisId);
                    
                        $this->redirect("index.php?route=admin-avis");
                    }
                     
                }