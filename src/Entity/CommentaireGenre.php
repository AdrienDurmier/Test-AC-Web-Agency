<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireGenreRepository")
 */

class CommentaireGenre extends Commentaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Genre", inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $genre;

    public function getGenre(): Genre
    {
        return $this->genre;
    }

    public function setGenre(Genre $genre): self
    {
        $this->genre = $genre;
        return $this;
    }

}
