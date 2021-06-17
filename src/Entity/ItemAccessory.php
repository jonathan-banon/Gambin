<?php

namespace App\Entity;

use App\Repository\ItemAccessoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemAccessoryRepository::class)
 */
class ItemAccessory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private int $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Accessory::class, inversedBy="itemAccessories")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Accessory $accessory;

    /**
     * @ORM\ManyToOne(targetEntity=Basket::class, inversedBy="itemAccessories")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Basket $basket;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getAccessory(): ?Accessory
    {
        return $this->accessory;
    }

    public function setAccessory(?Accessory $accessory): self
    {
        $this->accessory = $accessory;

        return $this;
    }

    public function getBasket(): ?Basket
    {
        return $this->basket;
    }

    public function setBasket(?Basket $basket): self
    {
        $this->basket = $basket;

        return $this;
    }
}
