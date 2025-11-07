<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ChatBoostRemoved;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ChatBoostRemovedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChatBoostRemoved::class);
    }
}
