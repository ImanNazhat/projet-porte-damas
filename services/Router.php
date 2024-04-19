<?php

class Router {
        
     
        public function handleRequest(array $get) : void {
            
               $authController = new AuthController();
               $pageController = new PageController();
                 
                if (isset($get["route"]))
                {
                  if ($get["route"] === "about") {
                      
                    $pageController->about();
                } 
                else if($get["route"] === "Nos-plats") {
                    
                    $pageController->menu();
                }
                else if($get["route"] === "Reserver") {
                    
                    $authController->reserver();
                }
                else if($get["route"] === "Votre-avis") {
                    
                    $authController->avis();
                } 
                 else if($get["route"] === "Connexion") {
                     
                    $authController->connexion();
                    
                } 
        }
        else {
                    $pageController->about();
                }
    } 
}