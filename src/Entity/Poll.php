<?php

namespace App\Entity;

use App\Enum\PollTypeEnum;
use App\Repository\PollRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PollRepository::class)]
class Poll
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $question = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $options = null;

    #[ORM\Column]
    private ?int $total_voter_count = null;

    #[ORM\Column]
    private ?bool $is_closed = null;

    #[ORM\Column]
    private ?bool $is_anonymous = null;

    #[ORM\Column(enumType: PollTypeEnum::class)]
    private ?PollTypeEnum $type = null;

    #[ORM\Column]
    private ?bool $allows_multiple_answers = null;

    #[ORM\Column]
    private ?int $correct_option_id = null;

    #[ORM\Column(length: 255)]
    private ?string $explanation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $explanation_entities = null;

    #[ORM\Column(nullable: true)]
    private ?int $open_period = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $close_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getOptions(): ?string
    {
        return $this->options;
    }

    public function setOptions(string $options): static
    {
        $this->options = $options;

        return $this;
    }

    public function getTotalVoterCount(): ?int
    {
        return $this->total_voter_count;
    }

    public function setTotalVoterCount(int $total_voter_count): static
    {
        $this->total_voter_count = $total_voter_count;

        return $this;
    }

    public function isClosed(): ?bool
    {
        return $this->is_closed;
    }

    public function setIsClosed(bool $is_closed): static
    {
        $this->is_closed = $is_closed;

        return $this;
    }

    public function isAnonymous(): ?bool
    {
        return $this->is_anonymous;
    }

    public function setIsAnonymous(bool $is_anonymous): static
    {
        $this->is_anonymous = $is_anonymous;

        return $this;
    }

    public function getType(): ?PollTypeEnum
    {
        return $this->type;
    }

    public function setType(PollTypeEnum $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function isAllowsMultipleAnswers(): ?bool
    {
        return $this->allows_multiple_answers;
    }

    public function setAllowsMultipleAnswers(bool $allows_multiple_answers): static
    {
        $this->allows_multiple_answers = $allows_multiple_answers;

        return $this;
    }

    public function getCorrectOptionId(): ?int
    {
        return $this->correct_option_id;
    }

    public function setCorrectOptionId(int $correct_option_id): static
    {
        $this->correct_option_id = $correct_option_id;

        return $this;
    }

    public function getExplanation(): ?string
    {
        return $this->explanation;
    }

    public function setExplanation(string $explanation): static
    {
        $this->explanation = $explanation;

        return $this;
    }

    public function getExplanationEntities(): ?string
    {
        return $this->explanation_entities;
    }

    public function setExplanationEntities(?string $explanation_entities): static
    {
        $this->explanation_entities = $explanation_entities;

        return $this;
    }

    public function getOpenPeriod(): ?int
    {
        return $this->open_period;
    }

    public function setOpenPeriod(?int $open_period): static
    {
        $this->open_period = $open_period;

        return $this;
    }

    public function getCloseDate(): ?\DateTime
    {
        return $this->close_date;
    }

    public function setCloseDate(?\DateTime $close_date): static
    {
        $this->close_date = $close_date;

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
