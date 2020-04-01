<?php

namespace App\Repository;

use App\Entity\Proprietaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Proprietaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Proprietaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Proprietaires[]    findAll()
 * @method Proprietaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProprietairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proprietaires::class);
    }
}