<?php
/**
 * Created by IntelliJ IDEA.
 * User: vova
 * Date: 30.12.13
 * Time: 14:44
 */

namespace GeekHub\BlogBundle\Entity;


use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    public function findLastBy(array $criteria)
    {
        $query = $this->getEntityManager()->createQueryBuilder('a')
            ->select('a' . $criteria['what'])
            ->orderBy('a' . $criteria['orderby'], 'DESC')
            ->setMaxResults($criteria['count'])
            ->getQuery();
        return $query->getResult();
    }
}