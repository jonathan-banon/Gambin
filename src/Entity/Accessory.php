<?php

namespace App\Entity;

use App\Repository\AccessoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccessoryRepository::class)
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private string $identifier;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private string $description;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private \DateTimeInterface $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private \DateTimeInterface $updated_at;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
    /**
     * @ORM\PreUpdate()
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
}
