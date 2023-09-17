<?php

namespace App\DTO;

use App\DTO\Interface\ResponseDataInterface;

class TaskDTO implements ResponseDataInterface
{
    public int $id;

    public string $title;

    public string $description;

    public int $createdAt;

    public ?int $updatedAt = null;

    public int $planeCompliteDate;

    public ?bool $isComplite = null;

    public int $userId;
}
