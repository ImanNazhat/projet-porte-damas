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
                    
                     public function checkCreateAvis() : void{
                        
                         if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["comment"]))
                            {
                                $username = $_POST["username"];
                                $email = $_POST["email"];
                                $comment = $_POST["comment"];
                                
                                $avis = new Avis($username, $email, $comment);
                                
                                
                                
                                $avisManager = new AvisManager();
                                
                                $createdAvis = $avisManager->createAvis($avis);
                                
                                $this->redirect("index.php?route=Votre-avis");
                            }
                    }
                    
                    
                    public function delete(int $avisId) : void{
                        
                        $avisManager = new AvisManager();
                        
                        $avisManager->delete($avisId);
                    
                        $this->redirect("index.php?route=admin-avis");
                    }
                     
                }