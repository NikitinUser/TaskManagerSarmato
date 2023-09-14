<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    #[Route('/api/task/all', name: 'api.task.all', methods: ['GET'])]
    public function actionGetAllUserTasks(): Response
    {
        return $this->json([]);
    }

    #[Route('/api/task/{id}', name: 'api.task.one', methods: ['GET'])]
    public function actionGetTask(): Response
    {
        return $this->json([]);
    }

    #[Route('/api/task', name: 'api.task.create', methods: ['POST'])]
    public function actionCreateTask(): Response
    {
        return $this->json([]);
    }

    #[Route('/api/task', name: 'api.task.update', methods: ['PATCH'])]
    public function actionUpdateTask(): Response
    {
        return $this->json([]);
    }

    #[Route('/api/task/done', name: 'api.task.done', methods: ['PATCH'])]
    public function actionDoneTask(): Response
    {
        return $this->json([]);
    }

    #[Route('/api/task', name: 'api.task.delete', methods: ['DELETE'])]
    public function actionDeleteTask(): Response
    {
        return $this->json([]);
    }
}
