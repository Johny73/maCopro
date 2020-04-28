<?php

namespace App\Repository;

use App\Entity\Comptes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Comptes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comptes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comptes[]    findAll()
 * @method Comptes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComptesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comptes::class);
    }

    public function findComptesUtilises()
    {
        return $this->createQueryBuilder('a')
            ->getQuery()
            ->getResult()
            ;
    }

}