<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PollAnswerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PollAnswerRepository::class)]
class PollAnswer
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Poll::class, cascade: ['persist'], inversedBy: 'PollAnswers')]
    #[ORM\JoinColumn(name: 'poll_id', referencedColumnName: 'id', nullable: false)]
    private ?Poll $poll = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'], inversedBy: 'PollAnswers')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $option_ids = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $created_at = null;

    public function getPoll(): ?Poll
    {
        return $this->poll;
    }

    public function setPoll(Poll $poll): static
    {
        $this->poll = $poll;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getOptionIds(): ?string
    {
        return $this->option_ids;
    }

    public function setOptionIds(string $option_ids): static
    {
        $this->option_ids = $option_ids;

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
