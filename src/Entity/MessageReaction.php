<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MessageReactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageReactionRepository::class)]
#[ORM\Index(name: 'user_id', columns: ['user_id'])]
#[ORM\Index(name: 'chat_id', columns: ['chat_id'])]
#[ORM\Index(name: 'actor_chat_id', columns: ['actor_chat_id'])]
class MessageReaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $id = null {
        get {
            return $this->id;
        }
    }

    #[ORM\ManyToOne(targetEntity: Chat::class, cascade: ['persist'], inversedBy: 'users')]
    #[ORM\JoinColumn(name: "chat_id", referencedColumnName: "id", nullable: false)]
    private ?Chat $chat = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $message_id = null;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'], inversedBy: 'messageReactions')]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Chat::class, cascade: ['persist'], inversedBy: 'actorChats')]
    #[ORM\JoinColumn(name: "actor_chat_id", referencedColumnName: "id", nullable: false)]
    private ?Chat $actorChat = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $old_reaction = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $new_reaction = null;

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

    public function getMessageid(): ?string
    {
        return $this->message_id;
    }

    public function setMessageid(string $message_id): static
    {
        $this->message_id = $message_id;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getActorChat(): ?Chat
    {
        return $this->actorChat;
    }

    public function setActorChat(?Chat $actorChat): static
    {
        $this->actorChat = $actorChat;

        return $this;
    }

    public function getOldReaction(): ?string
    {
        return $this->old_reaction;
    }

    public function setOldReaction(string $old_reaction): static
    {
        $this->old_reaction = $old_reaction;

        return $this;
    }

    public function getNewReaction(): ?string
    {
        return $this->new_reaction;
    }

    public function setNewReaction(string $new_reaction): static
    {
        $this->new_reaction = $new_reaction;

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
