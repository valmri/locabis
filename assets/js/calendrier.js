// Date courante
let date = new Date();
let dateString = date.getDate()+'/'+date.getMonth()+'/'+date.getFullYear();

// Récupération des dates déjà prises


// Configuration
let config = {
    plugins: [
        new rangePlugin({ input: "#dateFin"})
    ],
    locale: "fr",
    dateFormat: "d/m/Y",
    minDate: dateString,
    disable: {}
};

// Construction du calendrier
const calendar = flatpickr('#dateDebut', config);