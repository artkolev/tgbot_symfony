<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Chat;
use App\Entity\User;
use App\Entity\UserChat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserChatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserChat::class);
    }

    public function issetUserChat(User $user, Chat $chat): bool
    {
        return $this->findOneBy(['user' => $user, 'chat' => $chat]) !== null;
    }
}
