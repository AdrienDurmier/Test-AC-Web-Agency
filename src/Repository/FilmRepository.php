<?php

namespace App\Repository;

use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Film|null find($id, $lockMode = null, $lockVersion = null)
 * @method Film|null findOneBy(array $criteria, array $orderBy = null)
 * @method Film[]    findAll()
 * @method Film[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }

    /**
     * @param $filtres
     * @return Films[] Returns an array of User object
     */
    public function search(array $filtres = array())
    {
        $qb = $this->createQueryBuilder('f');

        if(isset($filtres['recherche'])) {
            $qb->join('f.genre', 'g');
            $qb->andWhere('LOWER(f.nom) LIKE LOWER(:recherche) OR LOWER(g.nom) LIKE LOWER(:recherche)');
            $qb->setParameter(':recherche' ,'%' . $filtres['recherche'] . '%');
        }

        if(isset($filtres['limit'])) {
            $qb->setMaxResults($filtres['limit']);
        }

        if(isset($filtres['offset'])) {
            $qb->setFirstResult($filtres['offset']);
        }


        $results = $qb->getQuery()->getResult();

        return $results;
    }
}