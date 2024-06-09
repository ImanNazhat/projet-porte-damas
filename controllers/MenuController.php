<?php

class MenuController extends AbstractController
                {
                    public function Menu() : void
                    {
                      $menu = new MenuManager;
                        
                        $menus = $menu->findAll();
                        
                     $this->render("main/menu.html.twig", [
                          "menus" => $menus
                          ]);
                    }
                                 
                    public function home() : void
                    {
                        $this->render("home.html.twig" , []);
                    }
                    public function create() : void{
                        $this->render("admin/admin-menu/create-menu.html.twig" , []);
                    }
                    
                    public function checkCreate() : void{
                        
                        if(isset($_POST['submit']) && isset($_POST["name"]) && isset($_POST["Description"]) && isset($_FILES["image"]) && isset($_POST["select"]))
                            {
                                $name = $_POST["name"];
                                $description = $_POST["Description"];
                                $select = $_POST["select"];
                                
                                // Traitement du fichier téléchargé
                                $image_tmp_name = $_FILES["image"]["tmp_name"];
                                $image_name = basename($_FILES["image"]["name"]);
                                $target_dir = "assets/img/"; 
                                $target_file = $target_dir . $image_name;
                        
                                if(move_uploaded_file($image_tmp_name, $target_file)) {
                                    // Le fichier a été téléchargé avec succès, vous pouvez maintenant créer l'objet Menu
                                    $menu = new Menu($name, $description, $target_file ,$select);
                                
                                    $menuManager = new MenuManager();
                                    
                                    $createdMenu = $menuManager->create($menu);
                                    
                                    // $this->redirect("index.php?route=admin-menu");
                                    $this->render("admin/admin-menu/admin-menu.html.twig" , []);
                                    
                                   
                                } 
                                else {
                                    echo "Une erreur s'est produite lors du téléchargement du fichier.";
                                }
                               
                            }
                    }
                    
                    
                    public function edit(int $menuId) : void
                    {
                        $menuManager = new MenuManager();
                        
                        $editMenu = $menuManager->findOne($menuId);
                        
                        //dump($editMenu);
                        
                        
                        $this->render("admin/admin-menu/edit-menu.html.twig" , ["menu" => $editMenu]);
                         
                    }
                    
                    public function checkEdit() : void{
                        
                        if(isset($_POST['submit']) && isset($_POST["name"]) && isset($_POST["Description"]) && isset($_FILES["image"]) && isset($_POST["select"]))
                            {
                                $name = $_POST["name"];
                                $description = $_POST["Description"];
                                $select = $_POST["select"];
                                $id = $_POST["id"];
                                
                                // Traitement du fichier téléchargé
                                $image_tmp_name = $_FILES["image"]["tmp_name"];
                                $image_name = basename($_FILES["image"]["name"]);
                                $target_dir = "assets/img/"; 
                                $target_file = $target_dir . $image_name;
                                
                                if(move_uploaded_file($image_tmp_name, $target_file)) {
                                    
                                $menu = new Menu($name, $description, $target_file,$select,$id);
                                
                                $menu->setId($id);
                                
                                $menuManager = new MenuManager();
                                
                                $editMenu = $menuManager->edit($menu);
                                
                                $this->redirect("index.php?route=admin-menu");
                                } 
                                else {
                                    echo "Une erreur s'est produite lors du téléchargement du fichier.";
                                }
                            }
                    }
                    
                    public function delete(int $menuId) : void{
                        
                        $menuManager = new MenuManager();
                        
                        $menuManager->delete($menuId);
                    
                        $this->redirect("index.php?route=admin-menu");
                    }
                    
                }