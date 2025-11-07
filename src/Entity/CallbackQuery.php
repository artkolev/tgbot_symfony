<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CallbackQueryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CallbackQueryRepository::class)]
class CallbackQuery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $id = null {
        get {
            return $this->id;
        }
    }

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'], inversedBy: 'CallbackQueries')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Chat::class, cascade: ['persist'], inversedBy: 'CallbackQueries')]
    #[ORM\JoinColumn(name: 'chat_id', referencedColumnName: 'id', nullable: true)]
    private ?Chat $chat = null;

    #[ORM\ManyToOne(targetEntity: Message::class, cascade: ['persist'], inversedBy: 'CallbackQueries')]
    #[ORM\JoinColumn(name: 'message_id', referencedColumnName: 'id', nullable: false)]
    private ?Message $message = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $inline_message_id = null;

    #[ORM\Column(length: 255)]
    private ?string $chat_instance = null;

    #[ORM\Column(length: 255)]
    private ?string $data = null;

    #[ORM\Column(length: 255)]
    private ?string $game_short_name = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $created_at = null;

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(?Chat $chat): static
    {
        $this->chat = $chat;

        return $this;
    }

    public function getMessage(): ?Message
    {
        return $this->message;
    }

    public function setMessage(?Message $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getInlineMessageId(): ?string
    {
        return $this->inline_message_id;
    }

    public function setInlineMessageId(?string $inline_message_id): static
    {
        $this->inline_message_id = $inline_message_id;

        return $this;
    }

    public function getChatInstance(): ?string
    {
        return $this->chat_instance;
    }

    public function setChatInstance(string $chat_instance): static
    {
        $this->chat_instance = $chat_instance;

        return $this;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(string $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function getGameShortName(): ?string
    {
        return $this->game_short_name;
    }

    public function setGameShortName(string $game_short_name): static
    {
        $this->game_short_name = $game_short_name;

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
