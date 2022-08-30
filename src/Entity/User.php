<?php

namespace App\Entity;

use App\Entity\Order;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['mail'], message: 'There is already an account with this mail')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $mail = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'userbis', targetEntity: Payment::class)]
    private Collection $Payment;

    #[ORM\OneToMany(mappedBy: 'userbis', targetEntity: order::class)]
    private Collection $orderbis;

    public function __construct()
    {
        $this->Payment = new ArrayCollection();
        $this->orderbis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->mail;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

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
     * @return Collection<int, Payment>
     */
    public function getPayment(): Collection
    {
        return $this->Payment;
    }

    public function addPayment(Payment $payment): self
    {
        if (!$this->Payment->contains($payment)) {
            $this->Payment->add($payment);
            $payment->setUserbis($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): self
    {
        if ($this->Payment->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getUserbis() === $this) {
                $payment->setUserbis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, order>
     */
    public function getOrderbis(): Collection
    {
        return $this->orderbis;
    }

    public function addOrderbis(order $orderbis): self
    {
        if (!$this->orderbis->contains($orderbis)) {
            $this->orderbis->add($orderbis);
            $orderbis->setUserbis($this);
        }

        return $this;
    }

    public function removeOrderbi(order $orderbis): self
    {
        if ($this->orderbis->removeElement($orderbis)) {
            // set the owning side to null (unless already changed)
            if ($orderbis->getUserbis() === $this) {
                $orderbis->setUserbis(null);
            }
        }

        return $this;
    }
}
