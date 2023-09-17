<?php

namespace App\Service;

use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Factory\TaskFactory;

class TaskService
{
    public const NOT_EXIST = "Task not exist";

    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @var int $userId
     * 
     * @return Task[]
     */
    public function getAllTasksByUserId(int $userId): array
    {
        return $this->taskRepository->findBy(
            [
                "userId" => $userId
            ]
        );
    }

    /**
     * @var int $userId
     * @var int $taskId
     * 
     * @return Task
     */
    public function getUserTask(int $userId, int $taskId): ?Task
    {
        return $this->taskRepository->findOneBy(
            [
                "userId" => $userId,
                "id" => $taskId
            ]
        );
    }

    /**
     * @var int $userId
     * @var array $taskData
     * 
     * @return Task
     */
    public function createTask(int $userId, array $taskData): Task
    {
        $task = TaskFactory::createFromArray($userId, $taskData);

        return $this->taskRepository->create($task);
    }

    /**
     * @var int $userId
     * @var array $taskData
     * 
     * @return Task
     */
    public function updateTask(int $userId, array $taskData): Task
    {
        $task = $this->getUserTask($userId, $taskData["id"]);

        if (is_null($task)) {
            throw new \RuntimeException(self::NOT_EXIST);
        }

        $task->setTitle($taskData["title"])
            ->setDescription($taskData["title"])
            ->setPlaneCompleteDate($taskData["planeCompleteDate"])
            ->setUpdatedAt(time());

        return $this->taskRepository->update($task);
    }

    /**
     * @var int $userId
     * @var int $taskId
     * 
     * @return Task
     */
    public function doneTask(int $userId, int $taskId): Task
    {
        $task = $this->getUserTask($userId, $taskId);

        if (is_null($task)) {
            throw new \RuntimeException(self::NOT_EXIST);
        }

        $task->setIsComplete(true)
            ->setUpdatedAt(time());

        return $this->taskRepository->update($task);
    }

    /**
     * @var int $userId
     * @var int $taskId
     * 
     * @return void
     */
    public function deleteTask(int $userId, int $taskId): void
    {
        $task = $this->getUserTask($userId, $taskId);

        if (is_null($task)) {
            throw new \RuntimeException(self::NOT_EXIST);
        }

        $this->taskRepository->delete($task);
    }
}
