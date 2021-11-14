<?php

namespace App\Repository;

use App\Entity\CommentaireFilm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommentaireFilm|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentaireFilm|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentaireFilm[]    findAll()
 * @method CommentaireFilm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireFilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentaireFilm::class);
    }
}
