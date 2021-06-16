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
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Item::class, inversedBy="itemAccessories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $item;

    /**
     * @ORM\ManyToOne(targetEntity=Accessory::class, inversedBy="itemAccessories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $accessory;

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

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

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
}
