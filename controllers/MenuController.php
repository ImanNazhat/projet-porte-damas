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
                    public function MenuVegetarian() : void
                    {
                        //pour essayer que ma function marche bien
                    //     $menuManager = new MenuManager();
                    //   $vegetarians = $menuManager->findAll();
                    //   dump($vegetarians);
                       
                    //   $menuManager = new MenuManager();
                    //   $vegetarians = $menuManager->findOne(3); //ici il faut que j'ai ecrir le numero de l'item que je le veux
                    //   dump($vegetarians);
                       
                    //   $menuManager = new MenuManager();
                    //   $vegetarians = $menuManager->findVegetarian();
                    //   dump($vegetarians);
                    }
                    public function home() : void
                    {
                        $this->render("home.html.twig" , []);
                    }
                    public function create() : void{
                        $this->render("admin/admin-menu/create-menu.html.twig" , []);
                    }
                    
                    public function checkCreate() : void{
                        
                        if(isset($_POST["name"]) && isset($_POST["Description"]) && isset($_POST["image-url"]) && isset($_POST["select"]))
                            {
                                $name = $_POST["name"];
                                $description = $_POST["Description"];
                                $imageUrl = $_POST["image-url"];
                                $select = $_POST["select"];
                                
                                $menu = new Menu($name, $description, $imageUrl,$select);
                                
                                $menuManager = new MenuManager();
                                
                                $createdMenu = $menuManager->create($menu);
                                
                                $this->redirect("index.php?route=admin-menu");
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
                        
                        if(isset($_POST["name"]) && isset($_POST["Description"]) && isset($_POST["image-url"]) && isset($_POST["select"]) && isset($_POST["id"]))
                            {
                                $name = $_POST["name"];
                                $description = $_POST["Description"];
                                $imageUrl = $_POST["image-url"];
                                $select = $_POST["select"];
                                $id = $_POST["id"];
                                
                                $menu = new Menu($name, $description, $imageUrl,$select,$id);
                                
                                $menu->setId($id);
                                
                                $menuManager = new MenuManager();
                                
                                $editMenu = $menuManager->edit($menu);
                                
                                $this->redirect("index.php?route=admin-menu");
                            }
                    }
                    
                    public function delete(int $menuId) : void{
                        
                        $menuManager = new MenuManager();
                        
                        $menuManager->delete($menuId);
                    
                        $this->redirect("index.php?route=admin-menu");
                    }
                    
                }