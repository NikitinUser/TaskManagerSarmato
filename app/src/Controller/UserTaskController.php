<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TaskService;
use App\DTO\HttpResponseDTO;
use App\Mapper\TaskMapper;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Request\CreateTaskRequest;
use App\Request\UpdateTaskRequest;

class UserTaskController extends AbstractController
{
    private TaskService $taskService;
    private HttpResponseDTO $httpResponseDTO;

    public function __construct(TaskService $taskService, HttpResponseDTO $httpResponseDTO)
    {
        $this->taskService = $taskService;
        $this->httpResponseDTO = $httpResponseDTO;
    }

    #[Route('/api/task/all', name: 'api.task.all', methods: ['GET'])]
    public function actionGetAllUserTasks(): Response
    {
        try {
            $userId = $this->getUser()?->getId();
            $tasks = $this->taskService->getAllTasksByUserId($userId);
            $this->httpResponseDTO->data = TaskMapper::mapFromArrayEntities($tasks);
        } catch (\Throwable $t) {
            $this->httpResponseDTO->error = $t->getMessage();
            $this->httpResponseDTO->responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $this->json($this->httpResponseDTO, $this->httpResponseDTO->responseCode);
    }

    #[Route('/api/task', name: 'api.task.one', methods: ['GET'])]
    public function actionGetTask(Request $request): Response
    {
        $id = (int)$request->query->get("id");

        try {
            $userId = $this->getUser()?->getId();
            $task = $this->taskService->getUserTask($userId, $id);
            $this->httpResponseDTO->data = TaskMapper::mapFromEntity($task);
        } catch (\Throwable $t) {
            $this->httpResponseDTO->error = $t->getMessage();
            $this->httpResponseDTO->responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $this->json($this->httpResponseDTO, $this->httpResponseDTO->responseCode);
    }

    #[Route('/api/task', name: 'api.task.create', methods: ['POST'])]
    public function actionCreateTask(Request $request, ValidatorInterface $validator): Response
    {
        try {
            $taskData = json_decode($request->getContent(), true);
            $taskValidation = new CreateTaskRequest($validator);
            $taskValidation->validate($taskData);
        } catch(\Throwable $t) {
            $this->httpResponseDTO->error = $t->getMessage();
            $this->httpResponseDTO->responseCode = Response::HTTP_BAD_REQUEST;
            return $this->json($this->httpResponseDTO, $this->httpResponseDTO->responseCode);
        }

        try {
            $userId = $this->getUser()?->getId();
            $task = $this->taskService->createTask($userId, $taskData);
            $this->httpResponseDTO->data = TaskMapper::mapFromEntity($task);
        } catch (\Throwable $t) {
            $this->httpResponseDTO->error = $t->getMessage();
            $this->httpResponseDTO->responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $this->json($this->httpResponseDTO, $this->httpResponseDTO->responseCode);
    }

    #[Route('/api/task', name: 'api.task.update', methods: ['PATCH'])]
    public function actionUpdateTask(Request $request, ValidatorInterface $validator): Response
    {
        try {
            $taskData = json_decode($request->getContent(), true);
            $taskValidation = new UpdateTaskRequest($validator);
            $taskValidation->validate($taskData);
        } catch(\Throwable $t) {
            $this->httpResponseDTO->error = $t->getMessage();
            $this->httpResponseDTO->responseCode = Response::HTTP_BAD_REQUEST;
            return $this->json($this->httpResponseDTO, $this->httpResponseDTO->responseCode);
        }

        try {
            $userId = $this->getUser()?->getId();
            $task = $this->taskService->updateTask($userId, $taskData);
            $this->httpResponseDTO->data = TaskMapper::mapFromEntity($task);
        } catch (\Throwable $t) {
            $this->httpResponseDTO->error = $t->getMessage();
            $this->httpResponseDTO->responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $this->json($this->httpResponseDTO, $this->httpResponseDTO->responseCode);
    }

    #[Route('/api/task/done', name: 'api.task.done', methods: ['PATCH'])]
    public function actionDoneTask(Request $request): Response
    {
        try {
            $jsonRequest = json_decode($request->getContent(), true);
            $id = (int)$jsonRequest["id"];
        } catch(\Throwable $t) {
            $this->httpResponseDTO->error = $t->getMessage();
            $this->httpResponseDTO->responseCode = Response::HTTP_BAD_REQUEST;
            return $this->json($this->httpResponseDTO, $this->httpResponseDTO->responseCode);
        }

        try {
            $userId = $this->getUser()?->getId();
            $task = $this->taskService->doneTask($userId, $id);
            $this->httpResponseDTO->data = TaskMapper::mapFromEntity($task);
        } catch (\Throwable $t) {
            $this->httpResponseDTO->error = $t->getMessage();
            $this->httpResponseDTO->responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $this->json($this->httpResponseDTO, $this->httpResponseDTO->responseCode);
    }

    #[Route('/api/task', name: 'api.task.delete', methods: ['DELETE'])]
    public function actionDeleteTask(Request $request): Response
    {
        $id = (int)$request->query->get("id");

        try {
            $userId = $this->getUser()?->getId();
            $this->taskService->deleteTask($userId, $id);
        } catch (\Throwable $t) {
            $this->httpResponseDTO->error = $t->getMessage();
            $this->httpResponseDTO->responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $this->json($this->httpResponseDTO, $this->httpResponseDTO->responseCode);
    }
}
