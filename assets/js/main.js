// If the DOM content of the page is fully loaded
window.addEventListener("DOMContentLoaded", function(){

    // Get the modals
    const deleteModal = document.getElementById('deleteModal');
    const editModal = document.getElementById('editModal');
    const showViande = document.getElementById("show-plats-de-viande");
    const showVegetarien = document.getElementById("show-plats-vegetarien");
    const showDessert = document.getElementById("show-desserts");

    // Check if the delete modal exists
    if (deleteModal) {
        // When the modal appears
        deleteModal.addEventListener("show.bs.modal", function(event) {
            const deleteButton = event.relatedTarget;

            // Get the URL of the route for deletion
            const url = deleteButton.getAttribute("data-url");
            const confirmDelete = document.getElementById("deleteConfirmButton");

            // If the confirm delete button is clicked
            confirmDelete.addEventListener("click", function(event) {
                // Redirect to the deletion route
                window.location.href = url;
            });
        });
    }
    
    // Check if the edit modal exists
    if (editModal) {
        // When the modal appears
        editModal.addEventListener("show.bs.modal", function(event) {
            const editButton = event.relatedTarget;

            // Get the URL of the route for editing
            const url = editButton.getAttribute("data-url");
            const confirmEdit = document.getElementById("editConfirmButton");

            // If the confirm edit button is clicked
            confirmEdit.addEventListener("click", function(event) {
                // Redirect to the editing route
                window.location.href = url;
            });
        });
    }
});

function showLoginError() {
    const loginForm = document.getElementById("login-form");
    const alertMessage = document.querySelector(".alert-message");
    const errorMessageElement = document.getElementById("error-message");
   

    loginForm.addEventListener("submit", function(event) {
        event.preventDefault();
        
        const formData = new FormData(loginForm);
        const options = {
            method: "POST",
            body: formData,
        };

        fetch("index.php?route=check-connexion", options)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Réponse du serveur non valide');
                }
                return response.json();
            })
            .then(data => {
                if (data && data.success) {
                    
                    if (data.user !== null ) {
                            window.location.href = "index.php?route=user"; 
                        } else {
                            
                            console.error("user non géré:", data.user);
                        }
                }    
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

window.addEventListener("DOMContentLoaded", function() {
    showLoginError();
});


