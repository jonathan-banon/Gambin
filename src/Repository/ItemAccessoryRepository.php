<?php

namespace App\Repository;

use App\Entity\ItemAccessory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ItemAccessory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemAccessory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemAccessory[]    findAll()
 * @method ItemAccessory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemAccessoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemAccessory::class);
    }

    // /**
    //  * @return ItemAccessory[] Returns an array of ItemAccessory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ItemAccessory
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
