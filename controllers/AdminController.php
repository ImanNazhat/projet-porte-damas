<?php

class AdminController extends AbstractController
{   
    // Method to manage reviews in the admin panel
    public function AdminAvis() : void 
     {
            if (isset($_SESSION["user"])){
                
            // Create a new instance of AvisManager
            $avis = new AvisManager;
            
            // Retrieve all reviews
            $aviss = $avis->findAll();
            
            // Render the admin reviews template with the retrieved reviews
            $this->render("admin/admin-avis/admin-avis.html.twig", [
                "aviss" => $aviss
            ]);
        
        }
        else{
            $this->redirect("index.php?route=Connexion");
        }
    } 
    
    // Method to manage reservations in the admin panel
    public function AdminReservation() : void 
    {
        if (isset($_SESSION["user"])){
            $reservation = new ReservationManager;
            
           
            $reservations = $reservation->findAll();
            
        
           
            $this->render("admin/admin-reservation/admin-reservation.html.twig", [
                "reservations" => $reservations
            ]);
        }
        else{
            $this->redirect("index.php?route=Connexion");
        }
    } 
 
    // Method to manage the menu in the admin panel
    public function AdminMenu() : void
    
    {
        if (isset($_SESSION["user"])) 
        {
            $menuManager = new MenuManager();
            $ingredientManager = new IngredientManager();
                            
            $menus = $menuManager->findAll();
                    
                    
             // Prepare array to store menus with their ingredients     
            $menusWithIngredients = [];
             
             // Loop through each menu to find and store its ingredients            
            foreach ($menus as $menu) {
                
                // Retrieve ingredients for the current menu using its ID
                $ingredients = $ingredientManager->findIngredientByMenuId($menu->getId());
                
                 // Store the current menu and its ingredients in $menusWithIngredients array
                $menusWithIngredients[] = [
                    'menu' => $menu,
                    'ingredients' => $ingredients
                ];
        }

                $this->render("admin/admin-menu/admin-menu.html.twig", [
                    "menusWithIngredients" => $menusWithIngredients
                ]);
            }
            
            else{
                $this->redirect("index.php?route=Connexion");
            }
    } 
    
    public function AdminIngredient() : void
    
    {
        if (isset($_SESSION["user"])) 
        {
             $ingredient = new IngredientManager;
            
          
            $ingredients = $ingredient->findAll();
            
       
            $this->render("admin/admin-menu/admin-ingredient.html.twig", [
                "ingredients" => $ingredients
            ]);
            
            }
            
            else{
                $this->redirect("index.php?route=Connexion");
            }
    } 
    // Method to manage users in the admin panel
    public function User() : void
    {
        if (isset($_SESSION["user"])) 
        {
                $user = new UserManager;
                
            
                $users = $user->findAll();
                
              
                $this->render("admin/user.html.twig", [
                    "users" => $users
                ]);
            }
            
            else{
                $this->redirect("index.php?route=Connexion");
            }
    } 
    
    // Method to render the create user template
    public function createUser() : void{
        $this->render("admin/create-user.html.twig", []);
    }
    
    
    public function checkCreateUser() : void {
        
        
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
            
             $this->redirect("index.php?route=user");
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
        
        $this->redirect("index.php?route=user");
    }
}
?>
