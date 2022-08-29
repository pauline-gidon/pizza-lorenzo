<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\Column(length: 65)]
    private ?string $type = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToOne(mappedBy: 'Payment', cascade: ['persist', 'remove'])]
    private ?Order $orderbis = null;

    #[ORM\ManyToOne(inversedBy: 'Payment')]
    private ?User $userbis = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getOrderbis(): ?Order
    {
        return $this->orderbis;
    }

    public function setOrderbis(?Order $orderbis): self
    {
        // unset the owning side of the relation if necessary
        if ($orderbis === null && $this->orderbis !== null) {
            $this->orderbis->setPayment(null);
        }

        // set the owning side of the relation if necessary
        if ($orderbis !== null && $orderbis->getPayment() !== $this) {
            $orderbis->setPayment($this);
        }

        $this->orderbis = $orderbis;

        return $this;
    }

    public function getUserbis(): ?User
    {
        return $this->userbis;
    }

    public function setUserbis(?User $userbis): self
    {
        $this->userbis = $userbis;

        return $this;
    }
}
