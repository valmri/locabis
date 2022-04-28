function createHiddenElement(equipement) {

    // Récupération de l'élément parent
    let parent = equipement.parentElement;

    if(!equipement.checked) {

        // Création de la base invisible
        let inputHidden = document.createElement("input");
        inputHidden.value = equipement.value;
        inputHidden.type = "hidden";
        inputHidden.name = "equipementsSuppr[]";
        inputHidden.id = "equipementsSuppr";

        parent.insertBefore(inputHidden, equipement);

    } else {

        // Suppression de l'élément invisible
        parent.removeChild(document.getElementById('equipementsSuppr'));

    }

}