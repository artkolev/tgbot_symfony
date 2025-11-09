<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ChatBoostUpdatedRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChatBoostUpdatedRepository::class)]
class ChatBoostUpdated
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $id = null;

    #[ORM\ManyToOne(targetEntity: Chat::class, cascade: ['persist'], inversedBy: 'ChatBoostsUpdated')]
    #[ORM\JoinColumn(name: 'chat_id', referencedColumnName: 'id', nullable: false)]
    private ?Chat $chat = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $boost = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBoost(): ?string
    {
        return $this->boost;
    }

    public function setBoost(?string $boost): static
    {
        $this->boost = $boost;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTime $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }
}
