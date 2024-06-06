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

document.addEventListener("DOMContentLoaded", () => {
    const categories = ['plats-de-viande', 'plats-végétarien', 'desserts'];

    categories.forEach(category => {
        fetch(`https://example.com/api/dishes?categories=${categories}`)
            .then(response => response.json())
            .then(data => {
                const dishesList = document.getElementById(`${categories}-dishes`);
                data.forEach(dish => {
                    const listItem = document.createElement('li');
                    listItem.className = 'dish';
                    listItem.textContent = dish.name;
                    dishesList.appendChild(listItem);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });
});