<?php

class Router {
        
        
        public function handleRequest(array $get) : void {
            
               $authController = new AuthController();
               $pageController = new PageController();
                 
                if (isset($get["route"]))
                {
                  if ($get["route"] === "qui-sommes-nous") {
                      
                    $pageController->about();
                } 
                else if($get["route"] === "nos-plats") {
                    
                    $pageController->menu();
                }
                else if($get["route"] === "reserver") {
                    
                    $authController->reserver();
                }
                else if($get["route"] === "votre-avis") {
                    
                    $authController->avis();
                } 
                 else if($get["route"] === "connexion") {
                     
                    
                    $authController->connexion();
                } 
                else {
                    $pageController->about();
                }
        }
    } 
}