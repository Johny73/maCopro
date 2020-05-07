<?php

namespace App\Repository;

use App\Entity\Journal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

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
        ->select('c.id as idCompteDebit, d.id as idCompteCredit, sum(j.montant) as debit, sum(j.montant) as credit')
        ->andWhere('YEAR(j.date) LIKE :searchTerm')
        ->setParameter('searchTerm', '%'.$yearJournal.'%')
        ->groupby('c.labelCompte, d.labelCompte')
        ->getQuery()
        ->getResult()
        ;
        return $response;
    }


    public function createJournalTdb(ComptesRepository $comptes, $yearJournal){
        $journalAggregate = $this->findJournalTdb($yearJournal);
        $listeComptes = $comptes->findAll();
        
        $response = Array();
        $varId = 0;
        $varLabel ='';
        $varMontantDebit = 0;
        $varMontantCredit = 0;
        foreach ($listeComptes as $compte){
            $varMontantDebit = 0;
            $varMontantCredit = 0;
            $varId = $compte->getId();
            $varLabel = $compte->getLabelCompte();
            foreach ($journalAggregate as $detailAggregate) {
                if ($detailAggregate['idCompteDebit'] === $varId){
                    $varMontantDebit +=  $detailAggregate['debit'];
                }
                if ($detailAggregate['idCompteCredit'] === $varId){
                    $varMontantCredit +=  $detailAggregate['credit'];
                }

            }
            Array_push($response, [$varId, $varLabel, $varMontantDebit, $varMontantCredit]);
            
        }
        return $response;
    }
}
