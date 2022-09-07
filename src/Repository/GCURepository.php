<?php

namespace Pdk\RgpdBundle\Repository;

use Pdk\RgpdBundle\Entity\GCU;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GCU>
 *
 * @method GCU|null find($id, $lockMode = null, $lockVersion = null)
 * @method GCU|null findOneBy(array $criteria, array $orderBy = null)
 * @method GCU[]    findAll()
 * @method GCU[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GCURepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GCU::class);
    }

    public function add(GCU $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GCU $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findCurrentGCU()
    {
        return $this
            ->createQueryBuilder('p')
            ->where('p.implementationDate <= :now')
            ->andWhere('p.isDraft = FALSE')
            ->orderBy('p.implementationDate', 'DESC')
            ->setParameter('now', new DateTime('now'))
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return GCU[] Returns an array of GCU objects
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

//    public function findOneBySomeField($value): ?GCU
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
