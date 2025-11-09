<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::BIGINT)]
    private ?string $id = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $is_bot = false;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $first_name = '';

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $last_name = null;

    #[ORM\Column(type: Types::STRING,length: 191, nullable: true)]
    private ?string $username = null;

    #[ORM\Column(type: Types::STRING,length: 10, nullable: true)]
    private ?string $language_code = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $is_premium = false;

    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $added_to_attachment_menu = false;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,nullable: true)]
    private ?\DateTime $updated_at = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function isBot(): ?bool
    {
        return $this->is_bot;
    }

    public function setIsBot(bool $is_bot): static
    {
        $this->is_bot = $is_bot;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

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

    public function getLanguageCode(): ?string
    {
        return $this->language_code;
    }

    public function setLanguageCode(?string $language_code): static
    {
        $this->language_code = $language_code;

        return $this;
    }

    public function isPremium(): ?bool
    {
        return $this->is_premium;
    }

    public function setIsPremium(bool $is_premium): static
    {
        $this->is_premium = $is_premium;

        return $this;
    }

    public function isAddedToAttachmentMenu(): ?bool
    {
        return $this->added_to_attachment_menu;
    }

    public function setAddedToAttachmentMenu(bool $added_to_attachment_menu): static
    {
        $this->added_to_attachment_menu = $added_to_attachment_menu;

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

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTime $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
