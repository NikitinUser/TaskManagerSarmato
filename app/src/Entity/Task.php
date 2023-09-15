<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    public const TASK_ACTIVE = 0;
    public const TASK_DONE = 1;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column(length: 5000)]
    private string $description;

    #[ORM\Column]
    private int $created_at;

    #[ORM\Column(nullable: true)]
    private ?int $updated_at = null;

    #[ORM\Column]
    private int $planeCompliteDate;

    #[ORM\Column]
    private int $status = self::TASK_ACTIVE;

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
        return $this->created_at;
    }

    public function setCreatedAt(int $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?int
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?int $updated_at): static
    {
        $this->updated_at = $updated_at;

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

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

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
