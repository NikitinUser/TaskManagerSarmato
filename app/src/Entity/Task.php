<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column(length: 5000)]
    private string $description;

    #[ORM\Column]
    private int $createdAt;

    #[ORM\Column(nullable: true)]
    private ?int $updatedAt = null;

    #[ORM\Column]
    private int $planeCompliteDate;

    #[ORM\Column]
    private bool $isComplite = false;

    #[ORM\Column]
    private int $userId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    public function setCreatedAt(int $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?int
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?int $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPlaneCompliteDate(): ?int
    {
        return $this->planeCompliteDate;
    }

    public function setPlaneCompliteDate(?int $planeCompliteDate): static
    {
        $this->planeCompliteDate = $planeCompliteDate;

        return $this;
    }

    public function getIsComplite(): bool
    {
        return $this->isComplite;
    }

    public function setIsComplite(bool $isComplite): static
    {
        $this->isComplite = $isComplite;

        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): static
    {
        $this->userId = $userId;

        return $this;
    }
}
