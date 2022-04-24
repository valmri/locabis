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

// Récupération des dates déjà réservées (fonction anonyme)
let recuperationDatesReservees = function (idAppartement) {

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
recuperationDatesReservees(1);

function constructionCalendrier(requeteHTTP) {

    /**
     * Todo: Faire les dates
     * 1 - Récupérer les dates
     * 2 - Les transformer au bon format
     * 3 - Les ajoutés dans un tableau
     * /!\ Revoir le mécanisme
     */
    console.log(requeteHTTP);

}