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

    // /**
    //  * @return Journal[]
    //  */
    public function findWithLabels()
    {
        $conn = $this->getEntityManager()
        ->getConnection();
    $sql = '
        SELECT a.id, a.date, b.label_compte AS compteDebit, c.label_compte AS compteCredit, a.montant, a.commentaire
        FROM Journal a
        JOIN comptes b 
            ON a.compte_debit_id = b.id
        JOIN comptes c
            ON a.compte_credit_id = c.id
        ORDER BY a.date DESC
        ';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
    }



}
