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
    <summary><h3>Run project in Docker</h3></summary>

    1 git clone https://github.com/NikitinUser/TaskManagerSarmato.git

    2 cd TaskManagerSarmato/docker

    3 run and login Docker

    4 sudo docker compose up --build

</details>

<details>
    <summary><h3>API</h3></summary>

<div>
    <a href="/swagger.json">swagger json</a>
</div>
<div>
    <a href="/swagger.yaml">swagger yaml</a>
</div>


host - http://127.0.0.1:7777

## Get token `/api/login_check` [POST]

The `/api/login_check` method is used to authenticate the user. It allows you to verify user credentials and get an JWT token.

### HTTP-запрос

- **Method:** POST
- **Required authentication:** False
- **Content type:** application/json

#### Request Body

- **Required:** True

1. `email` (string)
2. `password` (string)

Example:

```json
{
  "email": "admin@mail.ru",
  "password": "12345"
}
```

### Responses

#### Success (200)

- **Content type:** application/json

Example:

```json
{
  "token": "eyJ0...zVQ"
}
```

## Get all user tasks `/api/task/all` [GET]

### HTTP-запрос

- **Method:** GET
- **Required authentication:** True
- **Content type:** application/json
- **Authorization:** Bearer Token

### Responses

1. `error` (string or null)
2. `data` (array or null)

#### Success (200)

- **Content type:** application/json

Example:

```json
{
    "error": null,
    "data": [
        {
            "id": 1,
            "title": "test1",
            "description": "test1",
            "createdAt": 1694921959,
            "updatedAt": null,
            "planeCompliteDate": 1700170901,
            "status": 0,
            "userId": 1
        }
    ]
}
```

#### BAD REQUEST (400), SERVER ERROR (500)

- **Content type:** application/json

Example:

```json
{
    "error": "text",
    "data": null
}
```


## Get task by id `/api/task` [GET]

### HTTP-запрос

- **Method:** GET
- **Required authentication:** True
- **Content type:** application/json
- **Authorization:** Bearer Token

### URI Params

- **Required:** True

1. `id` - id of task

### Responses

1. `error` (string or null)
2. `data` (object or null)

#### Success (200)

- **Content type:** application/json

Example:

```json
{
    "error": null,
    "data":
        {
            "id": 1,
            "title": "test1",
            "description": "test1",
            "createdAt": 1694921959,
            "updatedAt": null,
            "planeCompliteDate": 1700170901,
            "status": 0,
            "userId": 1
        }
}
```

#### BAD REQUEST (400), SERVER ERROR (500)

- **Content type:** application/json

Example:

```json
{
    "error": "text",
    "data": null
}
```


## Create task `/api/task` [POST]

### HTTP-запрос

- **Method:** POST
- **Required authentication:** True
- **Content type:** application/json
- **Authorization:** Bearer Token

### Request body

- **Required:** True

1. `title` (string, max: 255, min: 1)
2. `description` (string, max: 2500, min: 1)
3. `planeCompliteDate` (int, max: 10, min: 10) - Planned task completion date (in UNIX timestamp format)

Example:

```json
{
    "title": "test1",
    "description": "test1",
    "planeCompliteDate": 1700170901
}
```

### Responses

1. `error` (string or null)
2. `data` (object or null)

#### Success (200)

- **Content type:** application/json

Example:

```json
{
    "error": null,
    "data":
        {
            "id": 1,
            "title": "test1",
            "description": "test1",
            "createdAt": 1694921959,
            "updatedAt": null,
            "planeCompliteDate": 1700170901,
            "status": 0,
            "userId": 1
        }
}
```

#### BAD REQUEST (400), SERVER ERROR (500)

- **Content type:** application/json

Example:

```json
{
    "error": "text",
    "data": null
}
```


## Update task `/api/task` [PATCH]

### HTTP-запрос

- **Method:** PATCH
- **Required authentication:** True
- **Content type:** application/json
- **Authorization:** Bearer Token

### Request body

- **Required:** True

1. `id` (int, min: 1)
2. `title` (string, max: 255, min: 1)
3. `description` (string, max: 2500, min: 1)
4. `planeCompliteDate` (int, max: 10, min: 10) - Planned task completion date (in UNIX timestamp format)

Example:

```json
{
    "id": 2,
    "title": "test2",
    "description": "test2 test3 test4",
    "planeCompliteDate": 1700170902
}
```

### Responses

1. `error` (string or null)
2. `data` (object or null)

#### Success (200)

- **Content type:** application/json

Example:

```json
{
    "error": null,
    "data":
        {
            "id": 1,
            "title": "test1",
            "description": "test1",
            "createdAt": 1694921959,
            "updatedAt": null,
            "planeCompliteDate": 1700170901,
            "status": 0,
            "userId": 1
        }
}
```

#### BAD REQUEST (400), SERVER ERROR (500)

- **Content type:** application/json

Example:

```json
{
    "error": "text",
    "data": null
}
```

## Done task `/api/task/done` [PATCH]

### HTTP-запрос

- **Method:** PATCH
- **Required authentication:** True
- **Content type:** application/json
- **Authorization:** Bearer Token

### Request body

- **Required:** True

1. `id` (int, min: 1)

Example:

```json
{
    "id": 2
}
```

### Responses

1. `error` (string or null)
2. `data` (object or null)

#### Success (200)

- **Content type:** application/json

Example:

```json
{
    "error": null,
    "data":
        {
            "id": 1,
            "title": "test1",
            "description": "test1",
            "createdAt": 1694921959,
            "updatedAt": null,
            "planeCompliteDate": 1700170901,
            "status": 1,
            "userId": 1
        }
}
```

#### BAD REQUEST (400), SERVER ERROR (500)

- **Content type:** application/json

Example:

```json
{
    "error": "text",
    "data": null
}
```


## Delete task `/api/task` [DELETE]

### HTTP-запрос

- **Method:** DELETE
- **Required authentication:** True
- **Content type:** application/json
- **Authorization:** Bearer Token

### URI Params

- **Required:** True

1. `id` - id of task

### Responses

1. `error` (string or null)
2. `data` (object or null)

#### Success (200)

- **Content type:** application/json

Example:

```json
{
    "error": null,
    "data": null
}
```

#### BAD REQUEST (400), SERVER ERROR (500)

- **Content type:** application/json

Example:

```json
{
    "error": "text",
    "data": null
}
```


##

</details>
