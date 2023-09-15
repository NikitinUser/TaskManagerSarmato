<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TaskService;
use App\DTO\HttpResponseDTO;
use App\Mapper\TaskMapper;
use App\Factory\TaskFactory;

class UserTaskController extends AbstractController
{
    private TaskService $taskService;
    private HttpResponseDTO $httpResponseDTO;
    private int $userId;

    public function __construct(TaskService $taskService, HttpResponseDTO $httpResponseDTO)
    {
        $this->taskService = $taskService;
        $this->httpResponseDTO = $httpResponseDTO;
        $this->userId = 1;
    }

    #[Route('/api/task/all', name: 'api.task.all', methods: ['GET'])]
    public function actionGetAllUserTasks(): Response
    {
        try {
            $tasks = $this->taskService->getAllTasksByUserId($this->userId);

            $this->httpResponseDTO->data = TaskMapper::mapFromArrayEntities($tasks);
        } catch (\Throwable $t) {
            // log
            $this->httpResponseDTO->error = $t->getMessage();
        }
        return $this->json($this->httpResponseDTO);
    }

    #[Route('/api/task/{id}', name: 'api.task.one', methods: ['GET'])]
    public function actionGetTask(int $id): Response
    {
        try {
            $task = $this->taskService->getUserTask($this->userId, $id);

            $this->httpResponseDTO->data = TaskMapper::mapFromEntity($task);
        } catch (\Throwable $t) {
            // log
            $this->httpResponseDTO->error = $t->getMessage();
        }
        return $this->json($this->httpResponseDTO);
    }

    #[Route('/api/task', name: 'api.task.create', methods: ['POST'])]
    public function actionCreateTask(): Response
    {
        $taskData = [];

        try {
            $task = TaskFactory::createFromArray($this->userId, $taskData);
            $task = $this->taskService->createTask($task);

            $this->httpResponseDTO->data = TaskMapper::mapFromEntity($task);
        } catch (\Throwable $t) {
            // log
            $this->httpResponseDTO->error = $t->getMessage();
        }

        return $this->json($this->httpResponseDTO);
    }

    #[Route('/api/task', name: 'api.task.update', methods: ['PATCH'])]
    public function actionUpdateTask(): Response
    {
        $taskData = [];

        try {
            $task = $this->taskService->updateTask($this->userId, $taskData);

            $this->httpResponseDTO->data = TaskMapper::mapFromEntity($task);
        } catch (\Throwable $t) {
            // log
            $this->httpResponseDTO->error = $t->getMessage();
        }

        return $this->json($this->httpResponseDTO);
    }

    #[Route('/api/task/done', name: 'api.task.done', methods: ['PATCH'])]
    public function actionDoneTask(): Response
    {
        $taskId = 1;

        try {
            $task = $this->taskService->doneTask($this->userId, $taskId);

            $this->httpResponseDTO->data = TaskMapper::mapFromEntity($task);
        } catch (\Throwable $t) {
            // log
            $this->httpResponseDTO->error = $t->getMessage();
        }

        return $this->json($this->httpResponseDTO);
    }

    #[Route('/api/task', name: 'api.task.delete', methods: ['DELETE'])]
    public function actionDeleteTask(): Response
    {
        $taskId = 1;

        try {
            $this->taskService->deleteTask($this->userId, $taskId);
        } catch (\Throwable $t) {
            // log
            $this->httpResponseDTO->error = $t->getMessage();
        }

        return $this->json($this->httpResponseDTO);
    }
}
