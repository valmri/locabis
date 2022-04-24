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

// Récupération des dates déjà réservées
function recuperationDatesReservees(idAppartement) {

    let requeteHTTP = getRequeteHttp();

    if (requeteHTTP == null) {
        alert("Impossible d'utiliser la technologie Ajax sur ce navigateur.");
    } else {
        requeteHTTP.open("POST", "./controleur/membre/php-xml/constructionCalendrier.php");

        requeteHTTP.onreadystatechange = function () {
            constructionCalendrier(requeteHTTP);
        };

        requeteHTTP.setRequestHeader(
            "Content-Type",
            "application/x-www-form-urlencoded"
        );

        requeteHTTP.send("id="+encodeURI(idAppartement));
    }

}

function constructionCalendrier(requeteHTTP) {

    let lesDates = requeteHTTP.responseXML.childNodes.item(0).childNodes;

    // Création de l'objet fichier
    let fichier = new Array();

    lesDates.forEach(uneDate=>{

        // Création des objets de dates
        let dateDebut = new Date(uneDate.childNodes.item(0).childNodes.item(0).data);
        let dateFin = new Date(uneDate.childNodes.item(1).childNodes.item(0).data);

        // Ajout des dates dans le tableau
        fichier.push({
            from: dateDebut.toLocaleDateString('fr'),
            to: dateFin.toLocaleDateString('fr')
        })

    });

    // Définition du calendrier
    // Date courante
    let dateCourante = new Date();

    // Configuration
    let config = {
        plugins: [
            new rangePlugin({ input: "#dateFin"})
        ],
        locale: "fr",
        dateFormat: "d-m-Y",
        minDate: dateCourante.toLocaleDateString('fr'),
        disable: {}
    };

    config.disable = fichier;

    console.log(config)

    // Construction du calendrier
    const calendar = flatpickr('#dateDebut', config);

}