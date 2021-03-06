<?php

namespace App\Entity;

use App\Repository\PackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity(repositoryClass=PackRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Pack
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private ?string $identifier;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private ?string $name;


    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */

    private \DateTimeInterface $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="packs")
     */
    private Collection $products;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, mappedBy="pack", cascade={"persist", "remove"})
     */
    private ?Image $image;

    /**
     * @ORM\OneToOne(targetEntity=Category::class, mappedBy="pack", cascade={"persist", "remove"})
     */
    private ?Category $category;

    /**
     * @ORM\Column(type="float")
     */
    private float $pricePerDay;

    /**
     * @ORM\Column(type="float")
     */
    private float $priceService;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;


    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
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

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        // unset the owning side of the relation if necessary
        if ($image === null && $this->image !== null) {
            $this->image->setPack(null);
        }

        // set the owning side of the relation if necessary
        if ($image !== null && $image->getPack() !== $this) {
            $image->setPack($this);
        }

        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        // unset the owning side of the relation if necessary
        if ($category === null && $this->category !== null) {
            $this->category->setPack(null);
        }

        // set the owning side of the relation if necessary
        if ($category !== null && $category->getPack() !== $this) {
            $category->setPack($this);
        }

        $this->category = $category;

        return $this;
    }

    public function getPricePerDay(): ?float
    {
        return $this->pricePerDay;
    }

    public function setPricePerDay(float $pricePerDay): self
    {
        $this->pricePerDay = $pricePerDay;

        return $this;
    }

    public function getPriceService(): ?float
    {
        return $this->priceService;
    }

    public function setPriceService(float $priceService): self
    {
        $this->priceService = $priceService;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPriceClean()
    {
        return $this->getPriceService();
    }
}
