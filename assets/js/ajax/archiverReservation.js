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

function archiverReservation(idAppartement, idReservation) {

    Swal.fire({
        title: 'Information',
        text: "Donnez votre avis avant d'archiver la réservation !",
        icon: 'info',
        showCancelButton: true,
        showDenyButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Donner son avis',
        denyButtonText: 'Archiver',
        cancelButtonText: 'Retour'
    }).then((result) => {
        if (result.isConfirmed) {

            document.location.href='?page=location&id='+idAppartement+'#avis';

        } else if (result.isDenied) {
            console.log('lol')
            // Traitement
            let requeteHTTP = getRequeteHttp();

            if (requeteHTTP == null) {
                alert("Impossible d'utiliser la technologie Ajax sur ce navigateur.");
            } else {
                requeteHTTP.open("POST", "./controleur/membre/php-xml/archiverReservation.php");

                requeteHTTP.onreadystatechange = function () {
                    affichageReservationArchivee(requeteHTTP);
                };

                requeteHTTP.setRequestHeader(
                    "Content-Type",
                    "application/x-www-form-urlencoded"
                );

                requeteHTTP.send("id="+encodeURI(idReservation));
            }

            Swal.fire({
                icon: 'success',
                title: "Réservation archivé !"
            })

        }
    })
}

function affichageReservationArchivee(requeteHTTP) {

    // Récupération de l'enregistrement
    let enregistement = requeteHTTP.responseXML.childNodes.item(0);

    // Récupération du booléen de confirmation
    let succesMaj = enregistement.childNodes.item('reponse').childNodes.item(0).data;

    if(succesMaj === 'true') {

        // Récupération des données
        let nouvelEtat = enregistement.childNodes.item(1);
        let idReservation = nouvelEtat.childNodes.item(0).childNodes.item(0).data;
        let iconeEtat = nouvelEtat.childNodes.item(1).childNodes.item(0).data;
        let libelleEtat = nouvelEtat.childNodes.item(2).childNodes.item(0).data;

        // Récupération des éléments html
        let carteReservation = document.getElementsByClassName('idReservations');

        // Recherche de l'élément HTML
        let i = 0;
        let resultat = false;

        while(i < carteReservation.length && !resultat) {

            let uneCarte = carteReservation.item(i);

            if(parseInt(uneCarte.value) === parseInt(idReservation)) {

                var laReservation = uneCarte.parentElement.childNodes.item(3);
                resultat = true;

            }

            i++;

        }

        // Mise à jour des valeurs
        if(resultat) {
            laReservation.childNodes.item(1).className = iconeEtat;
            laReservation.childNodes.item(3).data = libelleEtat
        } else {
            location.reload();
        }

    } else {

        Swal.fire({
            icon: 'error',
            title: "Échec de l'annulation."
        })

    }

}