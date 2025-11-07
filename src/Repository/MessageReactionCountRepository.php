<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\MessageReactionCount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MessageReactionCountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MessageReactionCount::class);
    }
}
