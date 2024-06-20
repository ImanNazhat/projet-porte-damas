<?php

// Declaration of the MenuController class extending AbstractController
class MenuController extends AbstractController
                {
                    // Method to display all menus
                    public function Menu() : void
                    {
                      $menu = new MenuManager;
                        
                        $menus = $menu->findAll();
                        
                     $this->render("main/menu.html.twig", [
                          "menus" => $menus
                          ]);
                    }
                    
                    // Method to display the home page             
                    public function home() : void
                    {
                        $this->render("home.html.twig" , []);
                    }
                    
                    // Method to display the create menu page
                    public function create() : void{
                        $this->render("admin/admin-menu/create-menu.html.twig" , []);
                    }
                    
                     // Method to check and create a menu
                    public function checkCreate() : void {
                        
                        // Check if the form is submitted and all fields are present
                        if (isset($_POST['submit']) && isset($_POST["name"]) && isset($_POST["Description"]) && isset($_FILES["image"]) && isset($_POST["select"])) {
                            $name = $_POST["name"];
                            $description = $_POST["Description"];
                            $select = $_POST["select"];
                            
                            // Handle the uploaded file
                            $image_tmp_name = $_FILES["image"]["tmp_name"];
                            $image_name = basename($_FILES["image"]["name"]);
                            $target_dir = "assets/img/"; 
                    
                            // Check the file type
                            $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
                            $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                            if (!in_array($file_extension, $allowed_types)) {
                                echo "Type de fichier non autorisé.";
                                return;
                            }
                    
                            // Check the file size (limited to 10MB, for example)
                            if ($_FILES["image"]["size"] > 10000000) {
                                echo "La taille du fichier est trop grande.";
                                return;
                            }
                    
                            // Rename the file to avoid conflicts
                            $new_image_name = uniqid('img_', true) . '.' . $file_extension;
                            $target_file = $target_dir . $new_image_name;
                    
                            if (move_uploaded_file($image_tmp_name, $target_file)) {
                                
                                // The file has been successfully uploaded, you can now create the Menu object
                                $menu = new Menu($name, $description, $target_file ,$select);
                                $menuManager = new MenuManager();
                                $createdMenu = $menuManager->create($menu);
                                
                                // Render the admin menu page
                                $this->render("admin/admin-menu/admin-menu.html.twig" , []);
                            } 
                            else {
                                echo "Une erreur s'est produite lors du téléchargement du fichier.";
                            }
                        }
                    }
                    
                    // Method to display the edit menu page
                    public function edit(int $menuId) : void
                    {
                        $menuManager = new MenuManager();
                        
                        $editMenu = $menuManager->findOne($menuId);
                        
                        
                        $this->render("admin/admin-menu/edit-menu.html.twig" , ["menu" => $editMenu]);
                         
                    }
                    
                    // Method to check and edit a menu
                    public function checkEdit() : void {
                        
                    if(isset($_POST['submit']) && isset($_POST["name"]) && isset($_POST["Description"]) && isset($_FILES["image"]) && isset($_POST["select"]))
                            {
                                $name = $_POST["name"];
                                $description = $_POST["Description"];
                                $select = $_POST["select"];
                                $id = $_POST["id"];
                                
                                
                                $image_tmp_name = $_FILES["image"]["tmp_name"];
                                $image_name = basename($_FILES["image"]["name"]);
                                $target_dir = "assets/img/"; 
                                $target_file = $target_dir . $image_name;
                                
                                // Check the file type
                                $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
                                $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                                if (!in_array($file_extension, $allowed_types)) {
                                    echo "Type de fichier non autorisé.";
                                    return;
                                }
                        
                                // Check the file size (limited to 10MB, for example)
                                if ($_FILES["image"]["size"] > 10000000) {
                                    echo "La taille du fichier est trop grande.";
                                    return;
                                }
                        
                                // Rename the file to avoid conflicts
                                $new_image_name = uniqid('img_', true) . '.' . $file_extension;
                                $target_file = $target_dir . $new_image_name;
                            
                                if(move_uploaded_file($image_tmp_name, $target_file)) {
                                    
                                $menu = new Menu($name, $description, $target_file,$select);
                                
                                $menu->setId($id);
                                
                                $menuManager = new MenuManager();
                                
                                $editMenu = $menuManager->edit($menu);
                                
                                $menu = new MenuManager;
                        
                                $menus = $menu->findAll();
                                    
                                 $this->render("admin/admin-menu/admin-menu.html.twig", [
                                      "menus" => $menus
                                      ]);
                                            } 
                                else {
                                    echo "Une erreur s'est produite lors du téléchargement du fichier.";
                                }
                            }
}
            
                    public function delete(int $menuId) : void{
                        
                        $menuManager = new MenuManager();
                        
                        $menuManager->delete($menuId);
                        
                        $menu = new MenuManager;
                        
                        $menus = $menu->findAll();
                    
                        $this->render("admin/admin-menu/admin-menu.html.twig" , ["menus" => $menus]);
                    }
                    
                }