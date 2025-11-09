<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PreCheckoutQueryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PreCheckoutQueryRepository::class)]
class PreCheckoutQuery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'], inversedBy: 'PreCheckoutQueries')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 3)]
    private ?string $currency = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $total_amount = null;

    #[ORM\Column(length: 255)]
    private ?string $invoice_payload = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_option_id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $order_info = null;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getTotalAmount(): ?string
    {
        return $this->total_amount;
    }

    public function setTotalAmount(string $total_amount): static
    {
        $this->total_amount = $total_amount;

        return $this;
    }

    public function getInvoicePayload(): ?string
    {
        return $this->invoice_payload;
    }

    public function setInvoicePayload(string $invoice_payload): static
    {
        $this->invoice_payload = $invoice_payload;

        return $this;
    }

    public function getShippingOptionId(): ?string
    {
        return $this->shipping_option_id;
    }

    public function setShippingOptionId(?string $shipping_option_id): static
    {
        $this->shipping_option_id = $shipping_option_id;

        return $this;
    }

    public function getOrderInfo(): ?string
    {
        return $this->order_info;
    }

    public function setOrderInfo(?string $order_info): static
    {
        $this->order_info = $order_info;

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
