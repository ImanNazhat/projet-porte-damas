<?php

// Declaration of the CategorieController class extending AbstractController
class CategorieController extends AbstractController
                {
                     // Method to display all categories
                     public function Categorie() : void
                      {
                            $categorie = new CategorieManager;
                                    
                            $categorie = $categorie->findAll();
                                   
                      }
                      
                     // Method to display meat categories            
                    public function CategorieViande() : void
                      {
                                   
                             $categorieManager = new CategorieManager();
                             
                             $meats = $categorieManager->findMeat();
                                    
                             $this->render("main/menu.html.twig", [
                                    "meats" => $meats
                              ]);
                       }
                     
                     // Method to display vegetarian categories           
                    public function CategorieVegetarian() : void
                                {
                                  $categorieManager = new CategorieManager();
                                  
                                  $vegetarians = $categorieManager->findVegetarian();
                                  
                                   $this->render("main/menu.html.twig", [
                                       "vegetarians" => $vegetarians
                                   ]);
                                }
                     
                     // Method to display dessert categories           
                    public function CategorieDessert() : void
                                {
                                 $categorieManager = new CategorieManager();
                                 
                                 $desserts = $categorieManager->findDessert();
                                 
                                  $this->render("main/menu.html.twig", [
                                       "desserts" => $desserts
                                   ]);
                                 
                                }
}