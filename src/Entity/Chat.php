<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\ChatTypeEnum;
use App\Repository\ChatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChatRepository::class)]
class Chat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private string $id;

    #[ORM\Column(enumType: ChatTypeEnum::class)]
    private ChatTypeEnum $type;

    #[ORM\Column(length: 255)]
    private string $title = '';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $username = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $last_name = null;

    #[ORM\Column]
    private bool $is_forum = false;

    #[ORM\Column]
    private bool $all_members_are_administrators = false;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $old_id = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getType(): ?ChatTypeEnum
    {
        return $this->type;
    }

    public function setType(ChatTypeEnum $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function isForum(): ?bool
    {
        return $this->is_forum;
    }

    public function setIsForum(bool $is_forum): static
    {
        $this->is_forum = $is_forum;

        return $this;
    }

    public function isAllMembersAreAdministrators(): ?bool
    {
        return $this->all_members_are_administrators;
    }

    public function setAllMembersAreAdministrators(bool $all_members_are_administrators): static
    {
        $this->all_members_are_administrators = $all_members_are_administrators;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getOldId(): ?string
    {
        return $this->old_id;
    }

    public function setOldId(?string $old_id): static
    {
        $this->old_id = $old_id;

        return $this;
    }
}
