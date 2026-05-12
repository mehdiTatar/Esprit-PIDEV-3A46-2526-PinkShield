<?php

namespace App\Repository;

use App\Entity\ForumComment;
use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** @extends ServiceEntityRepository<ForumComment> */
class ForumCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumComment::class);
    }

    /** @return ForumComment[] */
    public function findThreadForPost(Post $post): array
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.replies', 'r')->addSelect('r')
            ->andWhere('c.post = :post')
            ->andWhere('c.parentComment IS NULL')
            ->setParameter('post', $post)
            ->orderBy('c.createdAt', 'ASC')
            ->addOrderBy('r.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
