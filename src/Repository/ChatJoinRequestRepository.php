<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ChatJoinRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ChatJoinRequest>
 */
class ChatJoinRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChatJoinRequest::class);
    }
}
