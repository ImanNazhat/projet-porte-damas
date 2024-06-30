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
                    public function categorieViande() : void
                              {
                                    $ingredientManager = new IngredientManager();
                                    
                                    $categoryId = 1;
                                    
                                    $meats = $ingredientManager->findIngredientByCategory($categoryId);
                                    
                                    $menusMeats = [];
                                    
                                    foreach ($meats as $meat) {
                                        
                                        $menusMeats[] = [
                                            
                                            'meat' => [
                                                'id' => $meat['id'],
                                                'name' => $meat['name'],
                                                'picture' => $meat['picture']
                                                  ],
                                            'ingredients' => $meat['ingredients']
                                        ];
                                    }
                                    
                                    $this->render('main/menu.html.twig', [
                                        'menusMeats' => $menusMeats
                                    ]);
                        }
                       
                     
                     // Method to display vegetarian categories           
                   public function categorieVegetarian() : void
                        {
                            $ingredientManager = new IngredientManager();
                            
                            $categoryId = 2;
                            
                            $vegetarians = $ingredientManager->findIngredientByCategory($categoryId);
                            
                            $menusVegetarians = [];
                            
                            foreach ($vegetarians as $vegetarian) {
                                
                                $menusVegetarians[] = [
                                    
                                    'vegetarian' => [
                                        'id' => $vegetarian['id'],
                                        'name' => $vegetarian['name'],
                                        'picture' => $vegetarian['picture']
                                          ],
                                    'ingredients' => $vegetarian['ingredients']
                                ];
                            }
                            
                            // Affichez le résultat en utilisant la méthode render
                            $this->render('main/menu.html.twig', [
                                'menusVegetarians' => $menusVegetarians
                            ]);
                        }
                                    
                                
                     
                     // Method to display dessert categories           
                    public function categorieDessert() : void
                                {
                                 $ingredientManager = new IngredientManager();
                                    
                                    $categoryId = 3;
                                    
                                    $desserts = $ingredientManager->findIngredientByCategory($categoryId);
                                    
                                    $menusDesserts = [];
                                    
                                    foreach ($desserts as $dessert) {
                                        
                                        $menusDesserts[] = [
                                            
                                            'dessert' => [
                                                'id' => $dessert['id'],
                                                'name' => $dessert['name'],
                                                'picture' => $dessert['picture']
                                                  ],
                                            'ingredients' => $dessert['ingredients']
                                        ];
                                    }
                                    
                                    $this->render('main/menu.html.twig', [
                                        'menusDesserts' => $menusDesserts
                                    ]);
                                }
}