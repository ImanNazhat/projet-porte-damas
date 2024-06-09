<?php

class CategorieController extends AbstractController
                {
                     public function Categorie() : void
                                {
                                  $categorie = new CategorieManager;
                                    
                                  $categorie = $categorie->findAll();
                                  
                                   
                                }
                    public function CategorieViande() : void
                                {
                                   
                                    $categorieManager = new CategorieManager();
                                    $meats = $categorieManager->findMeat();
                                    
                                    $this->render("main/menu.html.twig", [
                                       "meats" => $meats
                                   ]);
                                }
                                
                    public function CategorieVegetarian() : void
                                {
                                  $categorieManager = new CategorieManager();
                                  $vegetarians = $categorieManager->findVegetarian();
                                  
                                   $this->render("main/menu.html.twig", [
                                       "vegetarians" => $vegetarians
                                   ]);
                                }
                                
                    public function CategorieDessert() : void
                                {
                                 $categorieManager = new CategorieManager();
                                 $desserts = $categorieManager->findDessert();
                                 
                                  $this->render("main/menu.html.twig", [
                                       "desserts" => $desserts
                                   ]);
                                 
                                }
}