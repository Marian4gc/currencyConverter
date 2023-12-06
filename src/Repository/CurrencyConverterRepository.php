<?php

namespace App\Repository;

use App\Entity\CurrencyConverter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CurrencyConverter>
 *
 * @method CurrencyConverter|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrencyConverter|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrencyConverter[]    findAll()
 * @method CurrencyConverter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyConverterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrencyConverter::class);
    }

//    /**
//     * @return CurrencyConverter[] Returns an array of CurrencyConverter objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CurrencyConverter
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
