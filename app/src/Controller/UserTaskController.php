<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TaskService;
use App\DTO\HttpResponseDTO;
use App\Mapper\TaskMapper;
use App\Factory\TaskFactory;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Validation\CreateTaskValidated;
use App\Validation\UpdateTaskValidated;

class UserTaskController extends AbstractController
{
    private TaskService $taskService;
    private HttpResponseDTO $httpResponseDTO;
    private SerializerInterface $serializer;
    private int $userId;

    public function __construct(TaskService $taskService, HttpResponseDTO $httpResponseDTO, SerializerInterface $serializer)
    {
        $this->taskService = $taskService;
        $this->httpResponseDTO = $httpResponseDTO;
        $this->serializer = $serializer;
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
        }
        return $this->json($this->httpResponseDTO);
    }

    #[Route('/api/task', name: 'api.task.one', methods: ['GET'])]
    public function actionGetTask(Request $request): Response
    {
        $id = $request->query->get("id");
        //todo validation
        try {
            $userId = $this->getUser()?->getId();

            $task = $this->taskService->getUserTask($userId, $id);

            if (!is_null($task)) {
                $this->httpResponseDTO->data = TaskMapper::mapFromEntity($task);
            }
        } catch (\Throwable $t) {
            $this->httpResponseDTO->error = $t->getMessage();
        }
        return $this->json($this->httpResponseDTO);
    }

    #[Route('/api/task', name: 'api.task.create', methods: ['POST'])]
    public function actionCreateTask(Request $request, ValidatorInterface $validator): Response
    {
        $taskData = $this->serializer->deserialize($request->getContent(), CreateTaskValidated::class, 'json');
        $validateResult = $validator->validate($taskData);

        if (count($validateResult)) {
            $errors = [];
            foreach ($validateResult as $error) {
                $field = $error->getPropertyPath();
                $errors[$field] = $error->getMessage();
            }

            $this->httpResponseDTO->error = $errors;
            return $this->json($this->httpResponseDTO, 400);
        }

        try {
            $userId = $this->getUser()?->getId();

            $task = TaskFactory::createFromValidated($userId, $taskData);
            
            $task = $this->taskService->createTask($task);

            $this->httpResponseDTO->data = TaskMapper::mapFromEntity($task);
        } catch (\Throwable $t) {
            $this->httpResponseDTO->error = $t->getMessage();
        }

        return $this->json($this->httpResponseDTO);
    }

    #[Route('/api/task', name: 'api.task.update', methods: ['PATCH'])]
    public function actionUpdateTask(Request $request, ValidatorInterface $validator): Response
    {
        $taskData = $this->serializer->deserialize($request->getContent(), UpdateTaskValidated::class, 'json');
        $validateResult = $validator->validate($taskData);

        if (count($validateResult)) {
            $errors = [];
            foreach ($validateResult as $error) {
                $field = $error->getPropertyPath();
                $errors[$field] = $error->getMessage();
            }

            $this->httpResponseDTO->error = $errors;
            return $this->json($this->httpResponseDTO, 400);
        }

        try {
            $userId = $this->getUser()?->getId();

            $task = $this->taskService->updateTask($userId, $taskData);

            $this->httpResponseDTO->data = TaskMapper::mapFromEntity($task);
        } catch (\Throwable $t) {
            $this->httpResponseDTO->error = $t->getMessage();
        }

        return $this->json($this->httpResponseDTO);
    }

    #[Route('/api/task/done', name: 'api.task.done', methods: ['PATCH'])]
    public function actionDoneTask(Request $request): Response
    {
        $id = json_decode($request->getContent(), true)["id"];
        //todo validation
        try {
            $userId = $this->getUser()?->getId();

            $task = $this->taskService->doneTask($userId, $id);

            $this->httpResponseDTO->data = TaskMapper::mapFromEntity($task);
        } catch (\Throwable $t) {
            $this->httpResponseDTO->error = $t->getMessage();
        }

        return $this->json($this->httpResponseDTO);
    }

    #[Route('/api/task', name: 'api.task.delete', methods: ['DELETE'])]
    public function actionDeleteTask(Request $request): Response
    {
        $id = $request->query->get("id");
        //todo validation
        try {
            $userId = $this->getUser()?->getId();

            $this->taskService->deleteTask($userId, $id);
        } catch (\Throwable $t) {
            $this->httpResponseDTO->error = $t->getMessage();
        }

        return $this->json($this->httpResponseDTO);
    }
}
