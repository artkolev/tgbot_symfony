<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EditedMessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EditedMessageRepository::class)]
class EditedMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $id = null {
        get {
            return $this->id;
        }
    }

    #[ORM\ManyToOne(targetEntity: Chat::class, cascade: ['persist'], inversedBy: 'EditedMessages')]
    #[ORM\JoinColumn(name: 'chat_id', referencedColumnName: 'id', nullable: true)]
    private ?string $chat = null;

    #[ORM\ManyToOne(targetEntity: Message::class, cascade: ['persist'], inversedBy: 'EditedMessages')]
    #[ORM\JoinColumn(name: 'message_id', referencedColumnName: 'id', nullable: false)]
    private ?string $message = null;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'], inversedBy: 'EditedMessages')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private ?string $user = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $edit_date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $entities = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $caption = null;

    public function getChat(): ?string
    {
        return $this->chat;
    }

    public function setChat(string $chat): static
    {
        $this->chat = $chat;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getEditDate(): ?\DateTime
    {
        return $this->edit_date;
    }

    public function setEditDate(?\DateTime $edit_date): static
    {
        $this->edit_date = $edit_date;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getEntities(): ?string
    {
        return $this->entities;
    }

    public function setEntities(string $entities): static
    {
        $this->entities = $entities;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): static
    {
        $this->caption = $caption;

        return $this;
    }
}
