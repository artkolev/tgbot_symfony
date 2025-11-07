<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MessageReactionCountRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageReactionCountRepository::class)]
class MessageReactionCount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $id = null {
        get {
            return $this->id;
        }
    }

    #[ORM\ManyToOne(targetEntity: Chat::class)]
    #[ORM\JoinColumn(name: "chat_id", referencedColumnName: "id", nullable: false)]
    private ?Chat $chat = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $message_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $reactions = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(Chat $chat): static
    {
        $this->chat = $chat;

        return $this;
    }

    public function getMessageId(): ?string
    {
        return $this->message_id;
    }

    public function setMessageId(string $message_id): static
    {
        $this->message_id = $message_id;

        return $this;
    }

    public function getReactions(): ?string
    {
        return $this->reactions;
    }

    public function setReactions(string $reactions): static
    {
        $this->reactions = $reactions;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }
}
