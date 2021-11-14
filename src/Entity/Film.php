<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmRepository")
 */
class Film
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Genre::class, inversedBy="films")
     * @ORM\JoinColumn(nullable=false)
     */
    private $genre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentaireFilm", mappedBy="film", cascade={"persist"})
     * @ORM\OrderBy({"dateCreation" = "ASC"})
     */
    private $commentaires;

    public function __toString()
    {
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection|CommentaireFilm[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(CommentaireFilm $commentaire): self
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire[] = $commentaire;
            $commentaire->setFilm($this);
        }
        return $this;
    }

    public function removeCommentaire(CommentaireFilm $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
        }
        return $this;
    }

    public function normalize(): array
    {
        return [
            'id' => $this->getId(),
            'nom' => $this->getNom(),
            'image' => $this->getImage(),
            'genre' => $this->getGenre()->normalize()
        ];
    }
}
