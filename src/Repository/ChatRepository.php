<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Chat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ChatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chat::class);
    }

    public function getCount(): int
    {
        return $this
            ->createQueryBuilder('c')
            ->select('COUNT(1) as count')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
