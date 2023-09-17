# TaskManagerSarmato
Test task to the Sarmato company

<details>
    <summary><h3>Task (translation of the original)</h3></summary>

        Develop a RESTful API for task management. Use the Symfony 6 framework and the MySQL database.

        Description:
        - There are users in the system, each of whom can create, view, update and delete their tasks.
        - The task consists of the following fields: title, description, creation date, completion date, status (completed or not).
        - The system must support the following actions:
            - View a list of all the user's tasks.
            - Creating a new task.
            - View information about the task.
            - Editing a task (changing the title, description, and completion date fields).
            - Deleting a task.
            - Marking the task as completed.

        Requirements:
            - The Symfony 6 framework should be used to create an API.
            - To work with the database, use the Doctrine ORM.
            - Add user authorization using authorization tokens (JWT or other).
            - Error handling and data validation must be implemented.
            - API documentation should be available.

        Results:
            - The source code of the developed API.
            - API documentation (in English) in Markdown format, containing a description of the available routes and request parameters.

        Additional tasks (an advantage):
            - Implement pagination and sorting when requesting a list of tasks.
            - Implement the ability to add comments to tasks.
            - Write unit tests for the created controllers and services.
</details>

<details>
    <summary><h3>Swagger</h3></summary>

    ```yaml
    openapi: 3.0.0
    info:
    title: Запрос списка задач
    description: Получение списка задач для пользователя
    version: 1.0.0
    servers:
    - url: http://127.0.0.1:7777
    paths:
    /api/task/all:
        get:
        summary: Получить список задач
        responses:
            200:
            description: Успешный запрос
            content:
                application/json:
                schema:
                    type: object
                    properties:
                    error:
                        type: string
                        nullable: true
                    data:
                        type: array
                        nullable: true
                        items:
                        type: object
                        properties:
                            id:
                            type: integer
                            description: Уникальный идентификатор задачи
                            title:
                            type: string
                            description: Заголовок задачи
                            description:
                            type: string
                            description: Описание задачи
                            createdAt:
                            type: integer
                            description: Дата создания задачи (в формате UNIX timestamp)
                            updatedAt:
                            type: integer
                            description: Дата последнего обновления задачи (в формате UNIX timestamp) или null
                            planeCompliteDate:
                            type: integer
                            description: Планируемая дата завершения задачи (в формате UNIX timestamp)
                            status:
                            type: integer
                            description: Статус задачи (0 - в процессе, 1 - завершена и т. д.)
                            userId:
                            type: integer
                            description: Идентификатор пользователя, связанного с задачей
            500:
            description: Внутренняя ошибка сервера


</details>


<details>
    <summary><h3>Запуск проекта в docker</h3></summary>
</details>

```yaml
openapi: 3.0.0
info:
title: Запрос списка задач
description: Получение списка задач для пользователя
version: 1.0.0
servers:
- url: http://127.0.0.1:7777
paths:
/api/task/all:
    get:
    summary: Получить список задач
    responses:
        200:
        description: Успешный запрос
        content:
            application/json:
            schema:
                type: object
                properties:
                error:
                    type: string
                    nullable: true
                data:
                    type: array
                    nullable: true
                    items:
                    type: object
                    properties:
                        id:
                        type: integer
                        description: Уникальный идентификатор задачи
                        title:
                        type: string
                        description: Заголовок задачи
                        description:
                        type: string
                        description: Описание задачи
                        createdAt:
                        type: integer
                        description: Дата создания задачи (в формате UNIX timestamp)
                        updatedAt:
                        type: integer
                        description: Дата последнего обновления задачи (в формате UNIX timestamp) или null
                        planeCompliteDate:
                        type: integer
                        description: Планируемая дата завершения задачи (в формате UNIX timestamp)
                        status:
                        type: integer
                        description: Статус задачи (0 - в процессе, 1 - завершена и т. д.)
                        userId:
                        type: integer
                        description: Идентификатор пользователя, связанного с задачей
        500:
        description: Внутренняя ошибка сервера
