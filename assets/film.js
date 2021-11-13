const filmsArea = document.getElementById('films');
var page = 1;
var recherche = '';

// Chargement de la première page sans filtre
renderFilms(page, recherche);

/**
 * Requête pour récupérer les films en fonction des paramètres
 * @param page
 * @param recherche
 * @returns {Promise<any>}
 */
export async function getFilms(page, recherche) {
    let url = '/api/films?page='+page;
    if(recherche !== ''){
        url += '&recherche='+recherche;
    }

    try {
        let res = await fetch(url);
        return await res.json();
    } catch (error) {
        console.error(error);
    }
}

/**
 * Rendu de la liste des films
 * @param page
 * @param recherche
 * @returns {Promise<void>}
 */
async function renderFilms(page, recherche) {
    if(filmsArea!==null){
        filmsArea.innerHTML = '';
        let films = await getFilms(page, recherche);
        films.forEach(film => {
            // Création d'un film
            let newFilm = document.createElement('div');
            newFilm.classList.add('flex-item');
            newFilm.classList.add('film-item');
            const newFilmImage = document.createElement('img')
            newFilmImage.src = film.image;
            newFilmImage.alt = film.nom;
            const newFilmTitre = document.createElement('h2')
            newFilmTitre.textContent = film.nom;
            newFilm.appendChild(newFilmImage);
            newFilm.appendChild(newFilmTitre);
            // Événement lors d'un clic
            newFilm.addEventListener('click', () => {
                displayModaleFilm(film);
            });
            filmsArea.appendChild(newFilm);
        });
    }
}

/**
 * Fenêtre modale
 * @param film
 */
export function displayModaleFilm(film){
    let oldModal = document.getElementById('modal');
    if (oldModal !== null){
        oldModal.remove();
    }
    let modal = document.createElement('div');
    modal.id = 'modal';
    modal.classList.add('modal');
    let modalContent = document.createElement('div');
    modalContent.classList.add('modal-content');
    let modalHeader = document.createElement('div');
    modalHeader.classList.add('modal-header');
    modalHeader.innerHTML = film.nom;
    let modalClose = document.createElement('div');
    modalClose.classList.add('modal-close');
    modalClose.innerHTML = 'X';
    modalClose.addEventListener('click', () => {
        modal.remove();
    });
    let modalBody = document.createElement('div');
    modalBody.classList.add('modal-body');
    modalBody.classList.add('modale-film-item');
    modalBody.innerHTML = `
        <img src="${film.image}" alt="${film.nom}">
        <br>
        <p>#${film.genre.nom}</p>
    `;

    modalHeader.appendChild(modalClose);
    modalContent.appendChild(modalHeader);
    modalContent.appendChild(modalBody);
    modal.appendChild(modalContent);
    document.body.appendChild(modal);
}