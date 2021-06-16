<?php

namespace App\Entity;

use App\Repository\BasketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BasketRepository::class)
 */
class Basket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\OneToOne(targetEntity=Rent::class, inversedBy="basket", cascade={"persist", "remove"})
     */
    private ?Rent $rent;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="baskets")
     */
    private ?User $user;

    /**
     * @ORM\OneToMany(targetEntity=ItemProduct::class, mappedBy="basket", orphanRemoval=true)
     */
    private Collection $itemProducts;

    /**
     * @ORM\OneToMany(targetEntity=ItemAccessory::class, mappedBy="basket", orphanRemoval=true)
     */
    private Collection $itemAccessories;

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

    public function setRent(?Rent $rent): self
    {
        $this->rent = $rent;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $itemProduct->setBasket($this);
        }

        return $this;
    }

    public function removeItemProduct(ItemProduct $itemProduct): self
    {
        if ($this->itemProducts->removeElement($itemProduct)) {
            // set the owning side to null (unless already changed)
            if ($itemProduct->getBasket() === $this) {
                $itemProduct->setBasket(null);
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
            $itemAccessory->setBasket($this);
        }

        return $this;
    }

    public function removeItemAccessory(ItemAccessory $itemAccessory): self
    {
        if ($this->itemAccessories->removeElement($itemAccessory)) {
            // set the owning side to null (unless already changed)
            if ($itemAccessory->getBasket() === $this) {
                $itemAccessory->setBasket(null);
            }
        }

        return $this;
    }
}
