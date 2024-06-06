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
                                
                                }
                                
                    public function CategorieVegetarian() : void
                                {
                                  $categorieManager = new CategorieManager();
                                  $vegetarian = $categorieManager->findVegetarian();
                                }
                                
                    public function CategorieDessert() : void
                                {
                                 $categorieManager = new CategorieManager();
                                 $dessert = $categorieManager->findDessert();
                                 
                                }
}