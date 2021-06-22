<?php

namespace App\Entity;

use App\Repository\RentRepository;
use Doctrine\ORM\Mapping as ORM;
use Datetime;

/**
 * @ORM\Entity(repositoryClass=RentRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Rent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="date")
     */
    private \DateTimeInterface $dateIn;

    /**
     * @ORM\Column(type="date")
     */
    private \DateTimeInterface $dateOut;


    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Deposit::class, inversedBy="rents")
     */
    private ?Deposit $deposit;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="rents")
     */
    private ?Status $status;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private \DateTimeInterface $dateReturn;

    /**
     * @ORM\OneToOne(targetEntity=Basket::class, mappedBy="rent", cascade={"persist", "remove"})
     */
    private ?Basket $basket;

    public function __sleep()
    {
        return [];
    }

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

    public function getDateIn(): ?\DateTimeInterface
    {
        return $this->dateIn;
    }

    public function setDateIn(\DateTimeInterface $dateIn): self
    {
        $this->dateIn = $dateIn;

        return $this;
    }

    public function getDateOut(): ?\DateTimeInterface
    {
        return $this->dateOut;
    }

    public function setDateOut(\DateTimeInterface $dateOut): self
    {
        $this->dateOut = $dateOut;

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

    public function getDeposit(): ?Deposit
    {
        return $this->deposit;
    }

    public function setDeposit(?Deposit $deposit): self
    {
        $this->deposit = $deposit;

        return $this;
    }
    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDateReturn(): ?\DateTimeInterface
    {
        return $this->dateReturn;
    }

    public function setDateReturn(?\DateTimeInterface $dateReturn): self
    {
        $this->dateReturn = $dateReturn;
        return $this;
    }

    public function getBasket(): ?Basket
    {
        return $this->basket;
    }

    public function setBasket(?Basket $basket): self
    {
        // unset the owning side of the relation if necessary
        if ($basket === null && $this->basket !== null) {
            $this->basket->setRent(null);
        }

        // set the owning side of the relation if necessary
        if ($basket !== null && $basket->getRent() !== $this) {
            $basket->setRent($this);
        }

        $this->basket = $basket;
        return $this;
    }

    public function getItemProducts()
    {
        $itemProducts = [];
        foreach ($this->getBasket()->getItemProducts() as $itemProduct) {
            $itemProducts[] = $itemProduct;
        }
        return $itemProducts;
    }

    public function getItemAccessories()
    {
        $itemAccessories = [];
        foreach ($this->getBasket()->getItemAccessories() as $itemAccessory) {
            $itemAccessory[] = $itemAccessory;
        }
        return $itemAccessories;
    }
}
