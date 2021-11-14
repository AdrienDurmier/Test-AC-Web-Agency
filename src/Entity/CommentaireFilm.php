<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireFilmRepository")
 */

class CommentaireFilm extends Commentaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Film", inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $film;

    public function getFilm(): Film
    {
        return $this->film;
    }

    public function setFilm(Film $film): self
    {
        $this->film = $film;
        return $this;
    }

}
