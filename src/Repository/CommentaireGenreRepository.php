<?php

namespace App\Repository;

use App\Entity\CommentaireGenre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommentaireGenre|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentaireGenre|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentaireGenre[]    findAll()
 * @method CommentaireGenre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireGenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentaireGenre::class);
    }
}
