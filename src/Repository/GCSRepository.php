<?php

namespace Pdk\RgpdBundle\Repository;

use Pdk\RgpdBundle\Entity\GCS;
use Pdk\RgpdBundle\Entity\GCU;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GCS>
 *
 * @method GCS|null find($id, $lockMode = null, $lockVersion = null)
 * @method GCS|null findOneBy(array $criteria, array $orderBy = null)
 * @method GCS[]    findAll()
 * @method GCS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GCSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GCS::class);
    }

    public function add(GCS $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GCS $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findCurrentGCS()
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
//     * @return GCS[] Returns an array of GCS objects
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

//    public function findOneBySomeField($value): ?GCS
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
