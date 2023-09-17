<?php

namespace App\Mapper;

use App\Entity\Task;
use App\DTO\TaskDTO;

class TaskMapper
{
    /**
     * @var Task $task
     * 
     * @return TaskDTO
     */
    public static function mapFromEntity(?Task $task): ?TaskDTO
    {
        if (is_null($task)) {
            return null;
        }

        $dto = new TaskDTO();

        $dto->id = $task->getId();
        $dto->title = $task->getTitle();
        $dto->description = $task->getDescription();
        $dto->createdAt = $task->getCreatedAt();
        $dto->updatedAt = $task->getUpdatedAt();
        $dto->planeCompliteDate = $task->getPlaneCompliteDate();
        $dto->isComplite = $task->getIsComplite();
        $dto->userId = $task->getUserId();

        return $dto;
    }

    /**
     * @var array Task[] $tasks
     * 
     * @return TaskDTO[]
     */
    public static function mapFromArrayEntities(array $tasks): array
    {
        return array_map(fn($task) => self::mapFromEntity($task), $tasks);
    }
}
