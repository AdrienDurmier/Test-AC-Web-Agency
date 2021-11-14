<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GenreRepository")
 */
class Genre
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Film::class, mappedBy="genre", orphanRemoval=true)
     */
    private $films;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentaireGenre", mappedBy="genre", cascade={"persist"})
     * @ORM\OrderBy({"dateCreation" = "ASC"})
     */
    private $commentaires;

    public function __toString()
    {
        return $this->nom;
    }

    public function __construct()
    {
        $this->films = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Film[]
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addFilm(Film $film): self
    {
        if (!$this->films->contains($film)) {
            $this->films[] = $film;
            $film->setGenre($this);
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        if ($this->films->removeElement($film)) {
            // set the owning side to null (unless already changed)
            if ($film->getGenre() === $this) {
                $film->setGenre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommentaireGenre[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(CommentaireGenre $commentaire): self
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire[] = $commentaire;
            $commentaire->setGenre($this);
        }
        return $this;
    }

    public function removeCommentaire(CommentaireGenre $commentaire): self
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
            'nom' => $this->getNom()
        ];
    }
}
