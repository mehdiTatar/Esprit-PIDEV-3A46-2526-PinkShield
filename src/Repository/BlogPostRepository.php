<?php

namespace App\Repository;

use App\Entity\BlogPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BlogPost>
 */
class BlogPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogPost::class);
    }

    /**
     * Returns a QueryBuilder for search+sort — used by KnpPaginator.
     */
    public function searchAndSortQueryBuilder(?string $search = null, ?string $sortBy = null): \Doctrine\ORM\QueryBuilder
    {
        $qb = $this->createQueryBuilder('b');

        if ($search) {
            $qb->andWhere('b.title LIKE :search OR b.content LIKE :search OR b.authorName LIKE :search')
               ->setParameter('search', '%' . $search . '%');
        }

        $orderBy  = 'b.createdAt';
        $orderDir = 'DESC';

        if ($sortBy === 'title_asc') {
            $orderBy = 'b.title';
            $orderDir = 'ASC';
        } elseif ($sortBy === 'title_desc') {
            $orderBy = 'b.title';
            $orderDir = 'DESC';
        } elseif ($sortBy === 'date_newest') {
            $orderBy = 'b.createdAt';
            $orderDir = 'DESC';
        } elseif ($sortBy === 'date_oldest') {
            $orderBy = 'b.createdAt';
            $orderDir = 'ASC';
        } elseif ($sortBy === 'author') {
            $orderBy = 'b.authorName';
            $orderDir = 'ASC';
        }

        $qb->leftJoin('b.comments', 'c')
           ->addSelect('c')
           ->orderBy($orderBy, $orderDir);

        return $qb;
    }
}
