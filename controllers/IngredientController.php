<?php

class IngredientController extends AbstractController
                {
                    public function Ingredient() : void
                    {
                     $ingredient = new IngredientManager ;
                        
                     $ingredients = $ingredient->findAll();
                        
                     $this->render("admin/admin-menu/admin-ingredient.html.twig", [
                          "ingredients" => $ingredients
                          ]);
                    }
                    
                    public function createIngredient() : void{
                        
                        $this->render("admin/admin-menu/create-ingredient.html.twig" , []);
                    }
                    
                    public function checkCreateIngredient() : void{
                        
                        if(isset($_POST["name"]))
                            {
                                $name = $_POST["name"];
                                
                                $ingredient = new Ingredient($name);
                                
                                $ingredientManager = new IngredientManager();
                                
                                $createdIngredient = $ingredientManager->create($ingredient);
                                
                                $this->redirect("index.php?route=admin-ingredient");
                    }
                    }
                    
                    public function editIngredient(int $ingredientId) : void
                    {
                        $ingredientManager = new IngredientManager();
                        
                        $editIngredient = $ingredientManager->findOne($ingredientId);
                        
                        $this->render("admin/admin-menu/edit-ingredient.html.twig" , ["ingredient" => $editIngredient]);
                         
                    }
                    
                    public function checkEditIngredient() : void{
                        
                        if(isset($_POST["name"]))
                            {
                                $name = $_POST["name"];
                                $id = $_POST["id"];
                                
                                $ingredient = new Ingredient($name,$id);
                                
                                $ingredient->setId($id);
                                
                                $ingredientManager = new IngredientManager();
                                
                                $editIngredient = $ingredientManager->edit($ingredient);
                                
                               $this->redirect("index.php?route=admin-ingredient");
                              }
                            }
                    
                    
                    public function delete(int $ingredientId) : void{
                        
                            $ingredientManager = new IngredientManager();
                            
                            $ingredientManager->delete($ingredientId);
                        
                            $this->redirect("index.php?route=admin-ingredient");
                        }
                    
                }