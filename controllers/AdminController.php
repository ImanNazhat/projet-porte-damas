<?php

class AdminController extends AbstractController
                {   
                    public function AdminAvis() : void 
                    {
                        $avis = new AvisManager;
                        
                        $aviss = $avis->findAll();
                        
                        
                       $this->render("admin/admin-avis/admin-avis.html.twig", [
                           "aviss" => $aviss
                       ]);
                    }
                    
                    public function AdminReservation() : void 
                    {
                       $reservation = new ReservationManager;
                        
                        $reservations = $reservation->findAll();
                        
                        
                       $this->render("admin/admin-reservation/admin-reservation.html.twig", [
                           "reservations" => $reservations
                       ]); 
                    } 
                    
                    public function AdminMenu() : void
                    {
                        $menu = new MenuManager;
                        
                        $menus = $menu->findAll();
                        //dump ($menus);
                        
                       $this->render("admin/admin-menu/admin-menu.html.twig", [
                           "menus" => $menus
                       ]);
                    } 
                    
                    public function User() : void
                    {
                        $user = new UserManager;
                        
                        $users = $user->findAll();
                        
                       $this->render("admin/user.html.twig", [
                           "users" => $users
                       ]);
                    } 
                    
                    public function createUser() : void{
                        $this->render("admin/create-user.html.twig" , []);
                    }
                    
                    public function checkCreateUser() : void {
                        
                        if(isset($_POST['submit']) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm-password"]))
                            { 
                                if($_POST["password"] === $_POST["confirm-password"]){
                                    
                                    $userManager = new UserManager();
                                    $existingUser = $userManager->findByEmail($_POST["email"]);
                                    
                                    if($existingUser === null)
                                            {   
                                                $username = htmlspecialchars($_POST['username']);
                                                $email = $_POST["email"];
                                                $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                                            
                                                $user = new User($username,$email, $password);
                                                
                            
                                                $userManager->createUser($user);
                            
                                                $_SESSION["user"] = $user->getId();
                                                
                                                $users = $userManager->findAll();
                                                
                                                $this->render("admin/user.html.twig",[
                                                    "users" => $users
                                                    ]);
                                            }
                                      
                                   else {
                                     $_SESSION["error-message"] = "L'email est déjà utilisé.";
                                     $this->render("admin/create-user.html.twig", ['error' => $_SESSION["error-message"]]);
                                    }
                            }   
                                else {
                                         $_SESSION["error-message"] = "Les mots de passe ne correspondent pas.";
                                        $this->render("admin/create-user.html.twig", ['error' => $_SESSION["error-message"]]);
                                       
                                      }
                                                        
                            }
                        }
            
        
                    public function editUser(int $userId) : void
                    {
                        $userManager = new UserManager();
                        
                        $editUser = $userManager->findOne($userId);
                        
                        $this->render("admin/edit-user.html.twig" , ["user" => $editUser]);
                         
                    }
                    
                    public function checkEditUser() : void{
                        
                        if(isset($_POST['submit']) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm-password"]))
                            {
                                $username = $_POST["username"];
                                $email = $_POST["email"];
                                $password = $_POST["password"];
                                $confirmPassword = $_POST["confirm-password"];
                                $id = $_POST["id"];
                                
                               
                                $user = new User($username, $email, $password ,$confirmPassword);
                                
                                $user->setId($id);
                                
                                $userManager = new UserManager();
                                
                                $editUser = $userManager->editUser($user);
                                
                               $this->render("admin/user.html.twig",[]);
                                } 
                                else {
                                    echo "Une erreur s'est produite lors du téléchargement du fichier.";
                                }
                            }
                    
                    
                    public function delete(int $userId) : void {
                        
                        $userManager = new UserManager();
                        
                        $userManager->delete($userId);
                    
                        $this->redirect("index.php?route=user");
                    }
                    
                }
                
            