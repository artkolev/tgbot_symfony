<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserChatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserChatRepository::class)]
class UserChat
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'], inversedBy: 'chats')]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false)]
    private ?User $user = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Chat::class, cascade: ['persist'], inversedBy: 'users')]
    #[ORM\JoinColumn(name: "chat_id", referencedColumnName: "id", nullable: false)]
    private ?Chat $chat = null;

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getChatId(): ?Chat
    {
        return $this->chat;
    }

    public function setChatId(Chat $chat): static
    {
        $this->chat = $chat;

        return $this;
    }
}
