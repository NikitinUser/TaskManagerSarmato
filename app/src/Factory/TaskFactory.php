<?php

namespace App\Service;

use App\Entity\Task;

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
}