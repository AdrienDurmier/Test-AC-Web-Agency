<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommmentaireRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorMap({
 *  "commentaire_film" = "CommentaireFilm",
 *  "commentaire_genre" = "CommentaireGenre",
 *  "commentaire_user" = "CommentaireUser"
 * })
 */
abstract class Commentaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $auteur;

    /**
     * Constructor
     */
    public function __construct() {
        $this->dateCreation = new \Datetime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    public function getContenu(): string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;
        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;
        return $this;
    }
}
