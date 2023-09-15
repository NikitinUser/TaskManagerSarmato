<?php

namespace App\Service;

use App\Entity\Task;
use App\Repository\TaskRepository;

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
        // todo sort, pagination
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
                "taskId" => $taskId
            ]
        );
    }

    /**
     * @var Task $task
     * 
     * @return Task
     */
    public function createTask(Task $task): Task
    {
        return $this->taskRepository->create($task);
    }

    /**
     * @var int $userId
     * @var int $taskId
     * 
     * @return Task
     */
    public function updateTask(int $userId, int $taskData): Task
    {
        $taskId = 1;
        $task = $this->getUserTask($userId, $taskId);

        if (is_null($task)) {
            throw new \RuntimeException(self::NOT_EXIST);
        }

        // конвертер?
        $task->setTitle($taskData["title"] ?: $task->getTitle())
            ->setDescription($taskData["description"] ?: $task->getTitle())
            ->setPlaneCompliteDate($taskData["description"] ?: $task->getTitle())
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

        $task->setStatus(Task::TASK_DONE)
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

        $this->taskRepository->dalete($task);
    }
}
