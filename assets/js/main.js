// si le dom de la page est bien chargé
window.addEventListener("DOMContentLoaded", function(){

    // Je récupère la modale
    const deleteModal = document.getElementById('deleteModal');
    const editModal = document.getElementById('editModal');
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

