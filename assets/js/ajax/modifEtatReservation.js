function getRequeteHttp() {
    let requeteHttp;
    if (window.XMLHttpRequest) {
        // Mozilla
        requeteHttp = new XMLHttpRequest();
        if (requeteHttp.overrideMimeType) {
            // Problème Mozilla
            requeteHttp.overrideMimeType("text/xml");
        }
    } else {
        if (window.ActiveXObject) {
            // Internet explorer < IE7
            try {
                requeteHttp = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    requeteHttp = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                    requeteHttp = null;
                }
            }
        }
    }
    return requeteHttp;
}

function modifEtat(etat) {

    // Déclaration des variables
    let libelleEtat;
    let idReservation = etat.parentElement.parentElement.childNodes.item(1).childNodes.item(0).data;
    let idEtat = etat.value;

    // Recherche du libelle à afficher
    switch (idEtat) {
        case '3':
            libelleEtat = "valider";
        break;
        case '2':
            libelleEtat = "refuser";
        break;
        default:
            libelleEtat = null;
    }

    if(libelleEtat !== null) {

        Swal.fire({
            title: 'Etes-vous sûre ?',
            text: "Voulez-vous "+libelleEtat+" la réservation n°"+idReservation+" ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {

                // Traitement
                let requeteHTTP = getRequeteHttp();

                if (requeteHTTP == null) {
                    alert("Impossible d'utiliser la technologie Ajax sur ce navigateur.");
                } else {
                    requeteHTTP.open("POST", "./controleur/membre/php-xml/modifEtatReservation.php");

                    requeteHTTP.onreadystatechange = function () {
                        affichageModifReservation(requeteHTTP);
                    };

                    requeteHTTP.setRequestHeader(
                        "Content-Type",
                        "application/x-www-form-urlencoded"
                    );

                    requeteHTTP.send("idEtat="+encodeURI(idEtat)+"&idReservation="+encodeURI(idReservation));
                }

                Swal.fire({
                    icon: 'success',
                    title: "État modifié avec succès !"
                })
            }
        })

    } else {

        Swal.fire({
            title: "Une erreur est survenu.",
            text: "L'état sélectionné est incorrect.",
            icon: "warning"
        })

    }

}

function affichageModifReservation(requeteHTTP) {

    // Récupération de l'enregistrement
    let enregistement = requeteHTTP.responseXML.childNodes.item(0);

    // Récupération du booléen de confirmation
    let succesMaj = enregistement.childNodes.item('reponse').childNodes.item(0).data;

    if(succesMaj === 'true') {

        // Récupération des données
        let nouvelEtat = enregistement.childNodes.item(1);
        let idReservation = nouvelEtat.childNodes.item(0).childNodes.item(0).data;
        let libelleEtat = nouvelEtat.childNodes.item(1).childNodes.item(0).data;

        // Récupération des éléments html
        let ligneReservation = document.getElementsByClassName('idReservations');
        console.log(ligneReservation)

        // Recherche de l'élément HTML
        let i = 0;
        let resultat = false;

        while(i < ligneReservation.length && !resultat) {

            let uneLigne = ligneReservation.item(i);

            if(parseInt(uneLigne.childNodes.item(0).data) === parseInt(idReservation)) {

                var laReservation = uneLigne.parentElement.childNodes.item(11);
                resultat = true;

            }

            i++;

        }

        // Mise à jour des valeurs
        if(resultat) {
            laReservation.textContent = libelleEtat
        }

    } else {

        Swal.fire({
            icon: 'error',
            title: "Échec de la mise à jour de l'état."
        })

    }

}