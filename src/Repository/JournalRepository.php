<?php

namespace App\Repository;

use App\Entity\Journal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Journal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Journal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Journal[]    findAll()
 * @method Journal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JournalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Journal::class);
    }

    /**
     * @return Journal[]
     */
    public function findWithLabels()
    {
        $response = $this->createQueryBuilder('j')
        ->leftJoin('j.compteDebit', 'c')
        ->leftJoin('j.compteCredit', 'd')
        ->select('j.id, j.date, c.labelCompte as compteDebit, d.labelCompte as compteCredit, j.montant, j.commentaire')
        ->orderBy('j.date', 'DESC')

        ->getQuery()
        ->getResult()
        ;
        return $response;
    }


    /**
    * @return Journal[] Returns an array of Journal object
    */
    public function findJournalTdb($yearJournal)
    {
        $response = $this->createQueryBuilder('j')
        ->leftJoin('j.compteDebit', 'c')
        ->leftJoin('j.compteCredit', 'd')
        ->select('c.labelCompte as compteDebit, d.labelCompte as compteCredit, sum(j.montant) as debit, sum(j.montant) as credit')
        ->andWhere('YEAR(j.date) LIKE :searchTerm')
        ->setParameter('searchTerm', '%'.$yearJournal.'%')
        ->groupby('c.labelCompte, d.labelCompte')
        ->getQuery()
        ->getResult()
        ;
        return $response;
    }
}
