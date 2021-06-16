<?php

namespace App\Entity;

use App\Repository\ItemProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemProductRepository::class)
 */
class ItemProduct
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
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="itemProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Product $product;

    /**
     * @ORM\ManyToOne(targetEntity=Basket::class, inversedBy="itemProducts")
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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

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
