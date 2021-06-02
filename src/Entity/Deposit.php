<?php

namespace App\Entity;

use App\Repository\DepositRepository;
use Doctrine\ORM\Mapping as ORM;
use Datetime;

/**
 * @ORM\Entity(repositoryClass=DepositRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Deposit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private ?string $identifier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $address;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $postalCode;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity=Rent::class, mappedBy="deposit", cascade={"persist", "remove"})
     */
    private $rent;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist(): void
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function onPreUpdate(): void
    {
        $this->updatedAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getRent(): ?Rent
    {
        return $this->rent;
    }

    public function setRent(Rent $rent): self
    {
        // set the owning side of the relation if necessary
        if ($rent->getDeposit() !== $this) {
            $rent->setDeposit($this);
        }

        $this->rent = $rent;

        return $this;
    }
}
