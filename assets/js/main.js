// If the DOM content of the page is fully loaded
window.addEventListener("DOMContentLoaded", function(){

    // Get the modals
    const deleteModal = document.getElementById('deleteModal');
    const editModal = document.getElementById('editModal');
   

    // Check if the delete modal exists
    if (deleteModal) {
       
        deleteModal.addEventListener("show.bs.modal", function(event) {
            const deleteButton = event.relatedTarget;

            // Get the URL of the route for deletion
            const url = deleteButton.getAttribute("data-url");
            const confirmDelete = document.getElementById("deleteConfirmButton");

            // If the confirm delete button is clicked
            confirmDelete.addEventListener("click", function(event) {
                
                window.location.href = url;
            });
        });
    }
    
    // Check if the edit modal exists
    if (editModal) {
        
        editModal.addEventListener("show.bs.modal", function(event) {
            const editButton = event.relatedTarget;

            // Get the URL of the route for editing
            const url = editButton.getAttribute("data-url");
            const confirmEdit = document.getElementById("editConfirmButton");

            // If the confirm edit button is clicked
            confirmEdit.addEventListener("click", function(event) {
               
                window.location.href = url;
            });
        });
    }
    
    
  
    const selectElement = document.getElementById('ingredients');
    const inputElement = document.getElementById('selectedIngredients');

    // Mise à jour de l'input text avec les options sélectionnées
    selectElement.addEventListener('change', () => {
        const selectedIngredients = Array.from(selectElement.selectedIngredients).map(ingredient => ingredient.text);
        inputElement.value = selectedIngredients.join(', ');
    });


});


       

function LoginError() {
    const loginForm = document.getElementById("login-form");
    const alertMessage = document.querySelector(".alert-message");
    const errorMessageElement = document.getElementById("error-message");
   
    // Add an event listener to the form submission
    loginForm.addEventListener("submit", function(event) {
        
         // Prevent the default form submission behavior // Empêche le comportement par défaut de soumission du formulaire
        event.preventDefault();
        
        // Create a FormData object with the form data
        const formData = new FormData(loginForm);
        
        // Options for the fetch request
        const options = {
            method: "POST",
            body: formData,
        };

         // Send a POST request to check the login
        fetch("index.php?route=check-connexion", options)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Réponse du serveur non valide');
                }
                
                 // Convert the response to JSON
                return response.json();
            })
            
            .then(data => {
                if (data && data.success) {
                    
                    if (data.user !== null ) {
                            window.location.href = "index.php?route=user"; 
                        }
                        
                    else {
                            
                            console.error("user non géré:", data.user);
                        }
                }   
                
                // Display the error message and show the alert
                else{
                            errorMessageElement.textContent = data.error;
                            alertMessage.style.display = "block";
                        }
            })
            .catch(error => {
                console.error("Erreur lors de la vérification de la connexion:", error);
                errorMessageElement.textContent = "Une erreur s'est produite lors de la vérification de la connexion.";
                alertMessage.style.display = "block";
            });
    });

}
            // Add an event listener to execute showLoginError when the DOM is loaded
            window.addEventListener("DOMContentLoaded", function() {
                LoginError();
            });


