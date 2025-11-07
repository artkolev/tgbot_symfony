<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ChatBoostRemovedRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChatBoostRemovedRepository::class)]
class ChatBoostRemoved
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $id = null;

    #[ORM\ManyToOne(targetEntity: Chat::class, cascade: ['persist'], inversedBy: 'ChatBoostsRemoved')]
    #[ORM\JoinColumn(name: 'chat_id', referencedColumnName: 'id', nullable: false)]
    private ?Chat $chat = null;

    #[ORM\Column(length: 200)]
    private ?string $boost_id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $remove_date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $source = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
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

    public function getBoostId(): ?string
    {
        return $this->boost_id;
    }

    public function setBoostId(string $boost_id): static
    {
        $this->boost_id = $boost_id;

        return $this;
    }

    public function getRemoveDate(): ?\DateTime
    {
        return $this->remove_date;
    }

    public function setRemoveDate(\DateTime $remove_date): static
    {
        $this->remove_date = $remove_date;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): static
    {
        $this->source = $source;

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
