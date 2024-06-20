<?php

class AdminController extends AbstractController
{   
    // Method to manage reviews in the admin panel
    public function AdminAvis() : void 
    {
        // Create a new instance of AvisManager
        $avis = new AvisManager;
        
        // Retrieve all reviews
        $aviss = $avis->findAll();
        
        // Render the admin reviews template with the retrieved reviews
        $this->render("admin/admin-avis/admin-avis.html.twig", [
            "aviss" => $aviss
        ]);
    }
    
    // Method to manage reservations in the admin panel
    public function AdminReservation() : void 
    {
    
        $reservation = new ReservationManager;
        
       
        $reservations = $reservation->findAll();
        
       
        $this->render("admin/admin-reservation/admin-reservation.html.twig", [
            "reservations" => $reservations
        ]); 
    } 
    
    // Method to manage the menu in the admin panel
    public function AdminMenu() : void
    {
       
        $menu = new MenuManager;
        
      
        $menus = $menu->findAll();
        
   
        $this->render("admin/admin-menu/admin-menu.html.twig", [
            "menus" => $menus
        ]);
    } 
    
    // Method to manage users in the admin panel
    public function User() : void
    {
      
        $user = new UserManager;
        
    
        $users = $user->findAll();
        
      
        $this->render("admin/user.html.twig", [
            "users" => $users
        ]);
    } 
    
    // Method to render the create user template
    public function createUser() : void{
        $this->render("admin/create-user.html.twig", []);
    }
    
    // Method to handle user creation
    public function checkCreateUser() : void {
        
        // Check if the form is submitted and all required fields are set
        if(isset($_POST['submit']) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm-password"])) { 
       
            // Check if the passwords match
            if($_POST["password"] === $_POST["confirm-password"]){
              
                // Create a new instance of UserManager
                $userManager = new UserManager();
            
                // Check if the email is already used
                $existingUser = $userManager->findByEmail($_POST["email"]);
                
                if($existingUser === null) {   
                
                    // Sanitize and hash user input
                    $username = htmlspecialchars($_POST['username']);
                    $email = $_POST["email"];
                    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    
                    // Create a new User instance
                    $user = new User($username, $email, $password);
                    
                    // Save the new user
                    $userManager->createUser($user);
                    
                    // Store the user ID in session
                    $_SESSION["user"] = $user->getId();
                    
                    // Retrieve all users and render the users template
                    $users = $userManager->findAll();
                    $this->render("admin/user.html.twig",[
                        "users" => $users
                    ]);
                } 
                
                else {
                    // Handle email already used error
                    $_SESSION["error-message"] = "L'email est déjà utilisé.";
                    $this->render("admin/create-user.html.twig", ['error' => $_SESSION["error-message"]]);
                }
            }
            
        else {
                // Handle passwords do not match error
                $_SESSION["error-message"] = "Les mots de passe ne correspondent pas.";
                $this->render("admin/create-user.html.twig", ['error' => $_SESSION["error-message"]]);
            }
        }
    }
    
    // Method to edit a user
    public function editUser(int $userId) : void
    {
       
        $userManager = new UserManager();
        
       
        $editUser = $userManager->findOne($userId);
        
    
        $this->render("admin/edit-user.html.twig", ["user" => $editUser]);
    }
    
    // Method to handle user editing
    public function checkEditUser() : void {
        
 
    if(isset($_POST['submit']) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm-password"])) {
       
        // Sanitize user input
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm-password"];
        $id = $_POST["id"];
        
     
        if ($password === $confirmPassword) {
           
           
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Create a new User instance with the hashed password
            $user = new User($username, $email, $hashedPassword, $confirmPassword);
            $user->setId($id);
            
            // Create a new instance of UserManager
            $userManager = new UserManager();
            
            // Update the user information
            $editUser = $userManager->editUser($user);
            
            // Retrieve all users
            $users = $userManager->findAll();
            
            // Render the admin users template with the retrieved users
            $this->render("admin/user.html.twig", [
                "users" => $users
            ]);
        }
        else {
            // Handle error if passwords do not match
            echo "Les mots de passe ne correspondent pas.";
        }
    } 
    else {
        // Handle error if form fields are not set
        echo "Une erreur s'est produite lors de la soumission du formulaire.";
    }
}
    
    // Method to delete a user
    public function delete(int $userId) : void {
        // Create a new instance of UserManager
        $userManager = new UserManager();
        
        // Delete the user
        $userManager->delete($userId);
        
         $users = $userManager->findAll();
         
        $this->render("admin/user.html.twig", [
                "users" => $users
            ]);
        
    }
}
?>
