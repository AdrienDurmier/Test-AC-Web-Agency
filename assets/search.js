import { getFilms, displayModaleFilm } from  './film.js';

const search = document.getElementById("search-input");
const searchResultat = document.getElementById("search-resultats");
var timeoutId;

/**
 * Événement lors de la saisie
 */
search.addEventListener("keydown", function(e) {
    searchResultat.classList.remove('hidden');
    // Déclenchement de la recherche (ici je laisse un délai de saisie de 500ms pour éviter que l'utilisateur ne déclenche une requête pour chaque keydown)
    clearTimeout(timeoutId);
    timeoutId = setTimeout(function () {
        rechercher();
    }, 500);

});


/**
 * Moteur de recherche
 */
async function rechercher() {
    // Réinitialisation de la recherche
    searchResultat.innerHTML = '';
    // Affichage des résultats sur les films où le terme recherché est dans le nom du film ou du genre
    let dataParNom = await getFilms(1, search.value);
    dataParNom.forEach(film => {
        // Création d'un résultat de recherche sur un film
        let resultat = document.createElement('div');
        resultat.classList.add('autocomplete-result');
        resultat.innerHTML = film.nom + ' <small>#' + film.genre.nom + '</small>';
        // Événement lors d'un clic
        resultat.addEventListener('click', () => {
            displayModaleFilm(film);
        });
        searchResultat.appendChild(resultat);
    });
}

/**
 * Fermeture de la recherche si on clique ailleurs
 */
window.addEventListener('click', function(e){
    if (document.getElementById('search-resultats').contains(e.target)){

    } else{
        searchResultat.innerHTML = '';
        searchResultat.classList.add('hidden');
    }
});