<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['order:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'Orderbis', targetEntity: OrderProduct::class)]
    private ?Collection $orderProducts = null;

    #[ORM\OneToOne(inversedBy: 'orderbis', cascade: ['persist', 'remove'])]
    private ?Payment $Payment = null;

    #[ORM\ManyToOne(inversedBy: 'orderbis')]
    private ?User $userbis = null;

    public function __construct()
    {
        $this->orderProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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

    /**
     * @return Collection<int, OrderProduct>
     */
    public function getOrderProducts(): ?Collection
    {
        return $this->orderProducts;
    }

    public function addOrderProduct(OrderProduct $orderProduct): self
    {
        if (!$this->orderProducts->contains($orderProduct)) {
            $this->orderProducts->add($orderProduct);
            $orderProduct->setOrderbis($this);
        }

        return $this;
    }

    public function removeOrderProduct(OrderProduct $orderProduct): self
    {
        if ($this->orderProducts->removeElement($orderProduct)) {
            // set the owning side to null (unless already changed)
            if ($orderProduct->getOrderbis() === $this) {
                $orderProduct->setOrderbis(null);
            }
        }

        return $this;
    }

    public function getPayment(): ?Payment
    {
        return $this->Payment;
    }

    public function setPayment(?Payment $Payment): self
    {
        $this->Payment = $Payment;

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
