<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function getCount(): int
    {
        $qb = $this->createQueryBuilder('m')
            ->select('COUNT(m.id) as count')
            ->setMaxResults(1);

        $result = $qb->getQuery()->getArrayResult();

        return $result[0]['count'] ?? 0;
    }
}
