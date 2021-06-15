<?php

namespace App\Entity;

use App\Repository\AccessoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity(repositoryClass=AccessoryRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("name")
 */
class Accessory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(name="name", type="string", length=100, nullable=false, unique=true )
     * @Assert\NotBlank
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private ?string $identifier;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private \DateTimeInterface $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="accessories")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Product $product;

    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="accessory")
     */
    private Collection $stocks;


    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="accessory")
     */
    private Collection $images;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $characteristic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $argumentOne;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $argumentTwo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $argumentThree;

    /**
     * @ORM\Column(type="float")
     */
    private float $pricePerDay;

    /**
     * @ORM\Column(type="float")
     */
    private float $priceService;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Collection|Stock[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->setAccessory($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getAccessory() === $this) {
                $stock->setAccessory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setAccessory($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getAccessory() === $this) {
                $image->setAccessory(null);
            }
        }

        return $this;
    }

    public function getCharacteristic(): ?string
    {
        return $this->characteristic;
    }

    public function setCharacteristic(?string $characteristic): self
    {
        $this->characteristic = $characteristic;

        return $this;
    }

    public function getArgumentOne(): ?string
    {
        return $this->argumentOne;
    }

    public function setArgumentOne(?string $argumentOne): self
    {
        $this->argumentOne = $argumentOne;

        return $this;
    }

    public function getArgumentTwo(): ?string
    {
        return $this->argumentTwo;
    }

    public function setArgumentTwo(?string $argumentTwo): self
    {
        $this->argumentTwo = $argumentTwo;

        return $this;
    }

    public function getArgumentThree(): ?string
    {
        return $this->argumentThree;
    }

    public function setArgumentThree(?string $argumentThree): self
    {
        $this->argumentThree = $argumentThree;

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

    public function getPriceClean()
    {
        return $this->getPriceService();
    }
}
