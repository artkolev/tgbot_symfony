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
        $qb = $this->createQueryBuilder('u')
            ->select('COUNT(u.id) as count')
            ->setMaxResults(1);

        $result = $qb->getQuery()->getArrayResult();

        return $result[0]['count'] ?? 0;
    }
}
