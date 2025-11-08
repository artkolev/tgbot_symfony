<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CommandChatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandChatRepository::class)]
class CommandChat
{
    #[ORM\Id]
    #[ORM\Column(length: 255)]
    private ?string $command = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Chat::class, cascade: ['persist'], inversedBy: 'commands')]
    #[ORM\JoinColumn(name: "chat_id", referencedColumnName: "id", nullable: false)]
    private ?Chat $chat = null;

    public function getCommand(): ?string
    {
        return $this->command;
    }

    public function setCommand(string $command): static
    {
        $this->command = $command;

        return $this;
    }

    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(Chat $chat): static
    {
        $this->chat = $chat;

        return $this;
    }
}
