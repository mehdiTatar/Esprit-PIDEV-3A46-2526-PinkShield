<?php

namespace App\Repository;

use App\Entity\Post;
use App\Entity\PostLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** @extends ServiceEntityRepository<PostLike> */
class PostLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostLike::class);
    }

    public function findOneForActor(Post $post, int $userId, string $role): ?PostLike
    {
        return $this->findOneBy([
            'post' => $post,
            'userId' => $userId,
            'userRole' => $role,
        ]);
    }

    /** @param Post[] $posts */
    public function findPostIdsLikedByActor(array $posts, int $userId, string $role): array
    {
        if ($posts === []) {
            return [];
        }

        $rows = $this->createQueryBuilder('l')
            ->select('IDENTITY(l.post) AS postId')
            ->andWhere('l.post IN (:posts)')
            ->andWhere('l.userId = :userId')
            ->andWhere('l.userRole = :role')
            ->setParameter('posts', $posts)
            ->setParameter('userId', $userId)
            ->setParameter('role', $role)
            ->getQuery()
            ->getScalarResult();

        return array_map('intval', array_column($rows, 'postId'));
    }
}
