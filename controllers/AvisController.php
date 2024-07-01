<?php

// Declaration of the AvisController class extending AbstractController
class AvisController extends AbstractController
                {   
                    // Method to display reviews
                    public function Avis() : void
                    {
                         // Create an instance of the reviews manager
                        $avis = new AvisManager;
                        
                         // Retrieve all reviews
                        $aviss = $avis->findAll();
                        
                        // Render the reviews page with the reviews
                         $this->render("main/avis.html.twig", [
                         "aviss" => $aviss
                         ]);
                    }
                    
                    // Method to create a review
                     public function createAvis() : void{
                         
                        $this->render("main/avis.html.twig" , []);
                    }
                    
                    // Method to check and create a review
                    public function checkCreateAvis() : void {
                        
                     // Check if the form is submitted
                    if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["comment"])) {
                       
                        // Sanitize and validate form fields 
                        $username = htmlspecialchars(trim($_POST["username"]), ENT_QUOTES, 'UTF-8');
                        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
                        $comment = htmlspecialchars(trim($_POST["comment"]), ENT_QUOTES, 'UTF-8');
                        
                        if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($username) && !empty($comment)) {
                            
                            // Create a new Review object with the form data
                            $avis = new Avis($username, $email, $comment);
                            
                            // Create an instance of the reviews manager
                            $avisManager = new AvisManager();
                            
                           // Add the review to the database
                            $createdAvis = $avisManager->createAvis($avis);
                            
                            $this->redirect("index.php?route=Votre-avis");
                        } 
                        else {
                            echo "Données invalides.";
                        }
                    }
                  }
                    
                     // Method to delete a review
                    public function delete(int $avisId) : void{
                        
                        $avisManager = new AvisManager();
                        
                        // Delete the review specified by its ID
                        $avisManager->delete($avisId);
                        
                         $this->redirect("index.php?route=admin-avis");
                        
                        }
                     
                }