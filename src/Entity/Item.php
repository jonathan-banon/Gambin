<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Rent::class, inversedBy="item", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $rent;

    /**
     * @ORM\OneToMany(targetEntity=ItemProduct::class, mappedBy="item", orphanRemoval=true)
     */
    private $itemProducts;

    /**
     * @ORM\OneToMany(targetEntity=ItemAccessory::class, mappedBy="item", orphanRemoval=true)
     */
    private $itemAccessories;

    public function __construct()
    {
        $this->itemProducts = new ArrayCollection();
        $this->itemAccessories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRent(): ?Rent
    {
        return $this->rent;
    }

    public function setRent(Rent $rent): self
    {
        $this->rent = $rent;

        return $this;
    }

    /**
     * @return Collection|ItemProduct[]
     */
    public function getItemProducts(): Collection
    {
        return $this->itemProducts;
    }

    public function addItemProduct(ItemProduct $itemProduct): self
    {
        if (!$this->itemProducts->contains($itemProduct)) {
            $this->itemProducts[] = $itemProduct;
            $itemProduct->setItem($this);
        }

        return $this;
    }

    public function removeItemProduct(ItemProduct $itemProduct): self
    {
        if ($this->itemProducts->removeElement($itemProduct)) {
            // set the owning side to null (unless already changed)
            if ($itemProduct->getItem() === $this) {
                $itemProduct->setItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ItemAccessory[]
     */
    public function getItemAccessories(): Collection
    {
        return $this->itemAccessories;
    }

    public function addItemAccessory(ItemAccessory $itemAccessory): self
    {
        if (!$this->itemAccessories->contains($itemAccessory)) {
            $this->itemAccessories[] = $itemAccessory;
            $itemAccessory->setItem($this);
        }

        return $this;
    }

    public function removeItemAccessory(ItemAccessory $itemAccessory): self
    {
        if ($this->itemAccessories->removeElement($itemAccessory)) {
            // set the owning side to null (unless already changed)
            if ($itemAccessory->getItem() === $this) {
                $itemAccessory->setItem(null);
            }
        }

        return $this;
    }

}
