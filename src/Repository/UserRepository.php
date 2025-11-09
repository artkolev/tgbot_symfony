<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getCount(): int
    {
        return $this
            ->createQueryBuilder('u')
            ->select('COUNT(1) as count')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
