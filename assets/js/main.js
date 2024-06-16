// si le dom de la page est bien chargé
window.addEventListener("DOMContentLoaded", function(){

    // Je récupère la modale
    const deleteModal = document.getElementById('deleteModal');
    const editModal = document.getElementById('editModal');
    const showViande = document.getElementById("show-plats-de-viande");
    const showVegetarien = document.getElementById("show-plats-vegetarien");
    const showDessert = document.getElementById("show-desserts");
    // Je vérifie si elle existe bien
    if(deleteModal)
    {
        // si la modale apparait
        deleteModal.addEventListener("show.bs.modal", function(event){
            const deleteButton = event.relatedTarget;

            // je récupère l'url de la route pour supprimer
            const url = deleteButton.getAttribute("data-url");
            const confirmDelete = document.getElementById("deleteConfirmButton");

            // si le bouton de confirmation est cliqué
            confirmDelete.addEventListener("click", function(event){
                // j'envoie vers la route qui supprime
                window.location.href = url;
            });
        });
    }
    
    if(editModal)
    {
        // si la modale apparait
        editModal.addEventListener("show.bs.modal", function(event){
            const editButton = event.relatedTarget;

            // je récupère l'url de la route pour supprimer
            const url = editButton.getAttribute("data-url");
            const confirmEdit= document.getElementById("editConfirmButton");

            // si le bouton de confirmation est cliqué
            confirmEdit.addEventListener("click", function(event){
                // j'envoie vers la route qui supprime
                window.location.href = url;
            });
        });
    }
    
    
});

function showLoginError() {
    const loginForm = document.getElementById("login-form");
    const alertMessage = document.querySelector(".alert-message");
    const errorMessageElement = document.getElementById("error-message");

    loginForm.addEventListener("submit", handleFormSubmit);

    async function handleFormSubmit(event) {
        event.preventDefault();

        const formData = new FormData(loginForm);

        try {
            const response = await fetch("index.php?route=checkConnexion", {
                method: "POST",
                body: formData,
                headers: {
                    "Accept": "application/json", // Indique que le client attend une réponse JSON
                    // Vous pouvez ajouter d'autres en-têtes si nécessaire
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            console.log('Response Data:', data);

            if (data.success) {
                window.location.href = data.redirect;
            } else {
                showErrorMessage(data.error);
            }
        } catch (error) {
            console.error("Fetch Error:", error);
            showErrorMessage("Une erreur s'est produite lors de la vérification de la connexion.");
        }
    }

    function showErrorMessage(message) {
        errorMessageElement.textContent = message;
        alertMessage.style.display = "block";
    }
}

window.addEventListener("DOMContentLoaded", showLoginError);