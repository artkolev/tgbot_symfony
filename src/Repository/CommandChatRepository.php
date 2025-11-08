<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\CommandChat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CommandChatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandChat::class);
    }

    public function getCount(): int
    {
        $qb = $this->createQueryBuilder('cc')
            ->select('COUNT(1) as count')
            ->setMaxResults(1);

        $result = $qb->getQuery()->getArrayResult();

        return $result[0]['count'] ?? 0;
    }
}
