const filmsArea = document.getElementById('films');
var offset = 1;
var limit = 3;

// Chargement de la première page sans filtre
renderFilms(offset, '');

/**
 * Requête pour récupérer les films en fonction des paramètres
 * @param offset
 * @param recherche
 * @returns {Promise<any>}
 */
export async function getFilms(offset, recherche) {
    let url = '/films?limit='+limit;
    if(offset > 1){
        url += '&offset='+offset;
    }
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
 * @param offset
 * @param recherche
 * @returns {Promise<void>}
 */
async function renderFilms(offset, recherche) {
    if(filmsArea!==null){
        filmsArea.innerHTML = '';
        let films = await getFilms(offset, recherche);
        let nbFilms = 0;
        films.forEach(film => {
            nbFilms++;
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

        // Pagination
        let btnLoadMoreExistant = document.getElementById('film-next-page');
        if(btnLoadMoreExistant){
            btnLoadMoreExistant.remove();
        }
        if(nbFilms > 0){
            let btnLoadMoreArea = document.createElement('div');
            btnLoadMoreArea.classList.add('text-center');
            let btnLoadMore = document.createElement('button');
            btnLoadMore.classList.add('btn');
            btnLoadMore.id = "film-next-page";
            btnLoadMore.innerHTML = "Page suivante <i class='fas fa-caret-right'></i>";
            btnLoadMore.addEventListener('click', () => {
                offset += limit;
                renderFilms(offset , recherche);
            });
            btnLoadMoreArea.appendChild(btnLoadMore);
            filmsArea.after(btnLoadMore);
        }
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
        <img src="/${film.image}" alt="${film.nom}">
        <br>
        <p><a href="/genre/${film.genre.id}"><i class="fas fa-tag"></i> ${film.genre.nom}</a></p>
        <p><a href="/film/${film.id}"><i class="fas fa-comments"></i> Voir les commentaires</a></p>
    `;

    modalHeader.appendChild(modalClose);
    modalContent.appendChild(modalHeader);
    modalContent.appendChild(modalBody);
    modal.appendChild(modalContent);
    document.body.appendChild(modal);
}


