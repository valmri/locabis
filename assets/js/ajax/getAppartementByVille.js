/**
 *Permet de rechercher les appartements par la ville
 */
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

// Pour les écrans tactiles
/*
let liste = document.getElementById('ville');

liste.addEventListener('touchstart', function(e){
    alert('test')
})
*/

function getAppartByVille(nomVille) {
    // Traitement
    let requeteHTTP = getRequeteHttp();

    if (requeteHTTP == null) {
    alert("Impossible d'utiliser la technologie Ajax sur ce navigateur.");
    } else {
    requeteHTTP.open("POST", "./controleur/membre/php-xml/getAppartementByVille.php");

    requeteHTTP.onreadystatechange = function () {
        affichageAppartements(requeteHTTP);
    };

    requeteHTTP.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
    );

    requeteHTTP.send("ville="+encodeURI(nomVille));
    }

}

function affichageAppartements(requeteHTTP) {
    
    // Récupération de l'enregistrement
    var enregistements = requeteHTTP.responseXML.childNodes.item(0);
    
    // Récupération du booléen de confirmation
    let succesMaj = enregistements.childNodes.item('reponse').childNodes.item(0).data;

    if(succesMaj == 'true') {
        
        // Récupération des appartements
        let listeAppartement = enregistements.childNodes.item(1);
       
       // Récupération du bloc HTML regroupant les locations
       let lesContenu = document.getElementById('lesContenus');

       // Suppression des contenus existant
        for(let i = 0; i <= lesContenu.getElementsByClassName('contenuCarte').length; i++) {

            lesContenu.getElementsByClassName('contenuCarte').item(0).remove();

        }

        // Création de la balise HTML contenant les cartes de présentations
        let contenu = document.createElement('div');
        contenu.setAttribute('class', 'contenuCarte');

        // Création des cartes de présentation

        listeAppartement.childNodes.forEach(unAppart => {

            // Bloc global
            let carte = document.createElement('div');
            carte.setAttribute('class', 'carteLoc');

            // Entête
            let enteteCarte = document.createElement('div');
            enteteCarte.setAttribute('class', 'carteLoc_entete');

            // Image de l'appartement
            let photo = document.createElement('img');
            photo.setAttribute('src', 'https://media.valmri.fr/locabis/apparts/'+unAppart.childNodes.item(1).childNodes.item(0).data+'.jpg');
            photo.setAttribute('alt', unAppart.childNodes.item(4).childNodes.item(0).data);
            photo.setAttribute('width', '100%');

            // Bloc de description
            let description = document.createElement('div');
            description.setAttribute('class', 'carteLoc_contenu');

            let titre = document.createElement('h2');
            let contenuTitre = document.createTextNode(unAppart.childNodes.item(2).childNodes.item(0).data);

            let ville =  document.createElement('span');
            ville.setAttribute('class', 'infoLoca');

            let iconeVille = document.createElement('i');
            iconeVille.setAttribute('class', 'las la-map-marker');

            let contenuVille = document.createTextNode(unAppart.childNodes.item(3).childNodes.item(0).data);

            let separateur = document.createElement('br');

            let typeAppart = document.createElement('span');
            typeAppart.setAttribute('class', 'infoLoca');

            let iconeTypeAppart = document.createElement('i');
            iconeTypeAppart.setAttribute('class', 'las la-home');

            let contenuTypeAppart = document.createTextNode(unAppart.childNodes.item(4).childNodes.item(0).data);

            let bouton = document.createElement('a');
            bouton.setAttribute('class', 'bouton');
            bouton.setAttribute('href', '?page=location&id='+unAppart.childNodes.item(0).childNodes.item(0).data);

            let boutonContenu = document.createTextNode('Consulter');

            // Construction de l'élément html
            titre.appendChild(contenuTitre);
            description.appendChild(titre);

            enteteCarte.appendChild(photo);
            carte.appendChild(enteteCarte);
            carte.appendChild(titre);
            carte.appendChild(description);
            ville.appendChild(iconeVille);
            ville.appendChild(contenuVille);
            carte.appendChild(ville)
            carte.appendChild(separateur);
            typeAppart.appendChild(iconeTypeAppart);
            typeAppart.appendChild(contenuTypeAppart);
            carte.appendChild(typeAppart);
            bouton.appendChild(boutonContenu);
            carte.appendChild(bouton);


            contenu.appendChild(carte);
            lesContenu.appendChild(contenu)

        })


    } else {

        Swal.fire({
            title: 'Aucuns appartements trouvés.',
            icon: 'info',
            showCancelButton: true,
            cancelButtonText: 'Retour',
            showConfirmButton: false
        })

    }

}
