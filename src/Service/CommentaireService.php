<?php

namespace App\Service;

use App\Entity\CommentaireFilm;
use App\Entity\CommentaireGenre;
use App\Entity\CommentaireUser;
use App\Entity\Film;
use App\Entity\Genre;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class CommentaireService
{
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    
    
    /**
     * Création d'un commentaire
     *
     * @param User $auteur
     * @param array $data
     */
    public function new(User $auteur, array $data)
    {
        if(isset($data['film'])){
            $commentaire = new CommentaireFilm();
            $film = $this->em->getRepository(Film::class)->find($data['film']);
            $commentaire->setFilm($film);
        }
        if(isset($data['genre'])){
            $commentaire = new CommentaireGenre();
            $genre = $this->em->getRepository(Genre::class)->find($data['genre']);
            $commentaire->setGenre($genre);
        }
        if(isset($data['user'])){
            $commentaire = new CommentaireUser();
            $user = $this->em->getRepository(User::class)->find($data['user']);
            $commentaire->setUser($user);
        }

        $commentaire->setContenu($data['contenu']);
        $commentaire->setAuteur($auteur);
        
        $this->em->persist($commentaire);
        $this->em->flush();
        return $commentaire;
    }
}