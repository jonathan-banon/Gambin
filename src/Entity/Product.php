<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("name")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;


    /**
     * @ORM\Column(type="string", length=100, nullable=false, unique=true)
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
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $storage;



    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private \DateTimeInterface $updatedAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $target;

    /**
     * @ORM\ManyToMany(targetEntity=Pack::class, mappedBy="products")
     */
    private Collection $packs;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank
     */
    private Marque $marque;

    /**
     * @ORM\OneToMany(targetEntity=Accessory::class, mappedBy="product")
     */
    private Collection $accessories;

    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="product")
     */
    private Collection $stocks;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="product")
     */
    private Collection $images;

    /**
     * @ORM\OneToMany(targetEntity=Rating::class, mappedBy="product")
     */
    private Collection $ratings;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, mappedBy="products")
     */
    private Collection $categories;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="favorites")
     */
    private Collection $users;

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
        $this->packs = new ArrayCollection();
        $this->accessories = new ArrayCollection();
        $this->ratings = new ArrayCollection();
        $this->stocks = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    public function getStorage(): ?string
    {
        return $this->storage;
    }

    public function setStorage(?string $storage): self
    {
        $this->storage = $storage;

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

    public function getTarget(): ?int
    {
        return $this->target;
    }

    public function setTarget(?int $target): self
    {
        $this->target = $target;

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
     * @return Collection|Pack[]
     */
    public function getPacks(): Collection
    {
        return $this->packs;
    }

    public function addPack(Pack $pack): self
    {
        if (!$this->packs->contains($pack)) {
            $this->packs[] = $pack;
            $pack->addProduct($this);
        }

        return $this;
    }

    public function removePack(Pack $pack): self
    {
        if ($this->packs->removeElement($pack)) {
            $pack->removeProduct($this);
        }

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * @return Collection|Accessory[]
     */
    public function getAccessories(): Collection
    {
        return $this->accessories;
    }

    public function addAccessory(Accessory $accessory): self
    {
        if (!$this->accessories->contains($accessory)) {
            $this->accessories[] = $accessory;
            $accessory->setProduct($this);
        }

        return $this;
    }

    public function removeAccessory(Accessory $accessory): self
    {
        if ($this->accessories->removeElement($accessory)) {
            // set the owning side to null (unless already changed)
            if ($accessory->getProduct() === $this) {
                $accessory->setProduct(null);
            }
        }

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
            $stock->setProduct($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getProduct() === $this) {
                $stock->setProduct(null);
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
            $image->setProduct($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProduct() === $this) {
                $image->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rating[]
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): self
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings[] = $rating;
            $rating->setProduct($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getProduct() === $this) {
                $rating->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addProduct($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addFavorite($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeFavorite($this);
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
}
