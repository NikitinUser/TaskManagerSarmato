<?php

namespace App\Factory;

use App\Entity\Task;
use App\Validation\ValidatedTaskInterface;

class TaskFactory
{
    /**
     * @var int $userId
     * @var array $taskData
     * 
     * @return Task
     */
    public static function createFromArray(int $userId, array $taskData): Task
    {
        $task = new Task();

        return $task->setUserId($userId)
            ->setTitle($taskData["title"])
            ->setDescription($taskData["description"])
            ->setPlaneCompliteDate($taskData["planeCompliteDate"])
            ->setCreatedAt(time());
    }

    public static function createFromValidated(int $userId, ValidatedTaskInterface $taskValidated)
    {
        $task = new Task();

        return $task->setUserId($userId)
            ->setTitle($taskValidated->title)
            ->setDescription($taskValidated->description)
            ->setPlaneCompliteDate($taskValidated->planeCompliteDate)
            ->setCreatedAt(time());
    }
}
