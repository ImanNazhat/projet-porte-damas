<?php

class Router {
        
     
        public function handleRequest(array $get) : void {
            
               $authController = new AuthController();
               $pageController = new PageController();
               $menuController = new MenuController();
               $adminController = new AdminController();
               $avisController = new AvisController();
               $categorieController = new CategorieController();
                 
                if (isset($get["route"]))
                {
                if ($get["route"] === "about") {
                      
                    $pageController->about();
                } 
                else if($get["route"] === "Nos-plats") {
                    
                    $menuController->Menu();
                }
                else if($get["route"] === "Reserver") {
                    
                    $authController->Reservation();
                }
                
                else if($get["route"] === "Votre-avis") {
                    
                    $avisController->Avis();
                } 
                 else if($get["route"] === "Connexion") {
                     
                    $authController->connexion();  
                }
                 else if ($get["route"] === "check-connexion")
                {
                    $authController->checkConnexion();
                }
                else if ($get["route"] === "legal")
                {
                    $pageController->legal();
                }
                
//******************admin reservation************************************//

                 else if($get["route"] === "admin-reservation") {
                    
                    $adminController->AdminReservation();
                }
                else if($get["route"] === "check-creer-reservation"){
                    
                    $authController->checkCreateReservation();
                }
//******************admin User************************************//

                else if ($get["route"] === "user")
                {
                    $adminController->User();
                }
                else if ($get["route"] === "user-creer-user")
                {
                    $adminController->createUser();
                }
                else if ($get["route"] === "user-check-creer-user")
                {
                    $adminController->checkCreateUser();
                }
                else if($get["route"] === "admin-modifier-user"){
                    
                    if (isset($get["user_id"])) {
                        
                    $userId = (int)$get["user_id"];
                    $adminController->editUser($userId);
                    }
                }
                else if($get["route"] === "admin-check-modifier-user"){
                    
                    $adminController->checkEditUser();
                }
                else if($get["route"] === "admin-supprimer-user"){
                    
                    if (isset($get["user_id"])) {
                        
                    $userId = (int)$get["user_id"];
                    $adminController->delete($userId);
                    }
                    else
                    {
                      echo "user_id n'existes pas pour la route admin-supprimer-user";
                    }
                }
//*******************************admin avis*********************************************************// 

                else if ($get["route"] === "admin-avis") {
                      
                    $adminController->AdminAvis();
                }
                else if($get["route"] === "creer-avis"){
                    
                    $avisController->createAvis();
                }
                 else if($get["route"] === "check-creer-avis"){
                    
                    $avisController->checkCreateAvis();
                }
                else if($get["route"] === "admin-supprimer-avis"){
                    
                    if (isset($get["avis_id"])) {
                        
                    $avisId = (int)$get["avis_id"];
                    $avisController->delete($avisId);
                    }
                    else
                    {
                      echo "avis_id n'existes pas pour la route admin-supprimer-avis";
                    }
                }
//*******************************admin menu*********************************************************//      

                else if($get["route"] === "admin-menu") {
                    
                    $adminController->AdminMenu();
                }
                
                else if($get["route"] === "admin-creer-menu"){
                    
                    $menuController->create();
                }
                else if($get["route"] === "admin-check-creer-menu"){
                    
                    $menuController->checkCreate();
                }
                else if($get["route"] === "admin-modifier-menu"){
                    
                    if (isset($get["menu_id"])) {
                        
                    $menuId = (int)$get["menu_id"];
                    $menuController->edit($menuId);
                    }
                }
                else if($get["route"] === "admin-check-modifier-menu"){
                    
                    $menuController->checkEdit();
                }
                else if($get["route"] === "admin-supprimer-menu"){
                    
                    if (isset($get["menu_id"])) {
                        
                    $menuId = (int)$get["menu_id"];
                    $menuController->delete($menuId);
                    }
                    else
                    {
                      echo "menu_id n'existes pas pour la route admin-supprimer-menu";
                    }
                }
//*******************************categories*********************************************************// 
                else if($get["route"] === "categorie-meat") {
                    
                    $categorieController->CategorieViande();
                }
                else if($get["route"] === "categorie-vegetarian") {
                    
                    $categorieController->CategorieVegetarian();
                }
                else if($get["route"] === "categorie-dessert") {
                    
                    $categorieController->CategorieDessert();
                }
                else if($get["route"] === "logout")
                {
                    $authController->logout();
                }
            } 
            else {
                    $pageController->about();
                }
                
            
        }
            
}