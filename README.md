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

## Task

### fields

#### id
* type: integer
* nullable: false
* description: unique identifier of task

#### title
* type: string
* max length: 255 in database, 127 in API (because there may be multibyte strings)
* min length: 0 in database, 1 in API
* validation regex pattern: '/^[A-Za-z А-Яа-яЁё 0-9]+$/u'
* nullable: false
* description: title of task

#### description
* type: string
* max length: 5000 in database, 2500 in API (because there may be multibyte strings)
* min length: 0 in database, 1 in API
* validation regex pattern: '/^[A-Za-z А-Яа-яЁё 0-9]+$/u'
* nullable: false
* description: text body for task

#### createdAt
* type: integer
* max length: 10
* min length: 10
* nullable: false
* default: current server date (by unixtime)
* description: date of creating tesk, integer because is unixtime for simplicity

#### updatedAt
* type: integer
* max length: 10
* min length: 10
* nullable: true
* default: null
* description: date of updating task, integer because is unixtime for simplicity

#### planeCompleteDate
* type: integer
* max length: 10
* min length: 10
* nullable: false
* description: the date when the user plans to complete the task, integer because is unixtime for simplicity

#### isComlite
* type: bool
* nullable: false
* default: false
* description: the mark on the completion of the task: false - the task is active, true - the task is completed.

#### userId
* type: integer
* nullable: false
* description: unique identifier of user who own a task

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

#### Unauthorized (401)

- **Content type:** application/json

Example:

```json
{
    "code": 401,
    "message": "Invalid credentials."
}
```

## Get all user tasks `/api/task/all` [GET]

The `/api/task/all` method is used to getting all tasks for current user.

### HTTP-запрос

- **Method:** GET
- **Required authentication:** True
- **Content type:** application/json
- **Authorization:** Bearer Token

### Responses

1. `message` (string or null)
2. `data` (array or null)

#### Success (200)

- **Content type:** application/json

Example:

```json
{
    "message": null,
    "data": [
        {
            "id": 1,
            "title": "test1",
            "description": "test1",
            "createdAt": 1694921959,
            "updatedAt": null,
            "planeCompleteDate": 1700170901,
            "isComplete": false,
            "userId": 1
        }
    ],
    "responseCode": 200
}
```

#### BAD REQUEST (400), SERVER ERROR (500)

- **Content type:** application/json

Example:

```json
{
    "message": "text",
    "data": null,
    "responseCode": 400 // 500
}
```

#### Unauthorized (401)

- **Content type:** application/json

Example:

```json
{
    "code": 401,
    "message": "Invalid credentials."
}
```


## Get task by id `/api/task` [GET]

The `/api/task` method is used to getting task for current user by task id.

### HTTP-запрос

- **Method:** GET
- **Required authentication:** True
- **Content type:** application/json
- **Authorization:** Bearer Token

### URI Params

- **Required:** True

1. `id` - id of task

### Responses

1. `message` (string or null)
2. `data` (object or null)

#### Success (200)

- **Content type:** application/json

Example:

```json
{
    "message": null,
    "data":
        {
            "id": 1,
            "title": "test1",
            "description": "test1",
            "createdAt": 1694921959,
            "updatedAt": null,
            "planeCompleteDate": 1700170901,
            "isComplete": false,
            "userId": 1
        },
    "responseCode": 200
```

#### BAD REQUEST (400), SERVER ERROR (500)

- **Content type:** application/json

Example:

```json
{
    "message": "text",
    "data": null,
    "responseCode": 400 // 500
}
```

#### Unauthorized (401)

- **Content type:** application/json

Example:

```json
{
    "code": 401,
    "message": "Invalid credentials."
}
```


## Create task `/api/task` [POST]

The `/api/task/all` method is used to creating a new task for current user.

### HTTP-запрос

- **Method:** POST
- **Required authentication:** True
- **Content type:** application/json
- **Authorization:** Bearer Token

### Request body

- **Required:** True

1. `title` (string, max: 127, min: 1, allow symbols: A-Za-z А-Яа-яЁё 0-9)
2. `description` (string, max: 2500, min: 1, allow symbols: A-Za-z А-Яа-яЁё 0-9)
3. `planeCompleteDate` (integer, max: 10, min: 10) - Planned task completion date (in UNIX timestamp format)

Example:

```json
{
    "title": "test1",
    "description": "test1",
    "planeCompleteDate": 1700170901
}
```

### Responses

1. `message` (string or null)
2. `data` (object or null)

#### Success (200)

- **Content type:** application/json

Example:

```json
{
    "message": null,
    "data":
        {
            "id": 1,
            "title": "test1",
            "description": "test1",
            "createdAt": 1694921959,
            "updatedAt": null,
            "planeCompleteDate": 1700170901,
            "isComplete": false,
            "userId": 1
        },
    "responseCode": 200
}
```

#### BAD REQUEST (400), SERVER ERROR (500)

- **Content type:** application/json

Example:

```json
{
    "message": "text",
    "data": null,
    "responseCode": 400 // 500
}
```

#### Unauthorized (401)

- **Content type:** application/json

Example:

```json
{
    "code": 401,
    "message": "Invalid credentials."
}
```


## Update task `/api/task` [PATCH]

The `/api/task` method is used to update fields title, description, planeCompleteDate in task.

### HTTP-запрос

- **Method:** PATCH
- **Required authentication:** True
- **Content type:** application/json
- **Authorization:** Bearer Token

### Request body

- **Required:** True

1. `id` (integer, min: 1)
2. `title` (string, max: 255, min: 1, allow symbols: A-Za-z А-Яа-яЁё 0-9)
3. `description` (string, max: 2500, min: 1, allow symbols: A-Za-z А-Яа-яЁё 0-9)
4. `planeCompleteDate` (integer, max: 10, min: 10) - Planned task completion date (in UNIX timestamp format)

Example:

```json
{
    "id": 2,
    "title": "test2",
    "description": "test2 test3 test4",
    "planeCompleteDate": 1700170902
}
```

### Responses

1. `message` (string or null)
2. `data` (object or null)

#### Success (200)

- **Content type:** application/json

Example:

```json
{
    "message": null,
    "data":
        {
            "id": 1,
            "title": "test1",
            "description": "test1",
            "createdAt": 1694921959,
            "updatedAt": null,
            "planeCompleteDate": 1700170901,
            "isComplete": false,
            "userId": 1
        },
    "responseCode": 200
}
```

#### BAD REQUEST (400), SERVER ERROR (500)

- **Content type:** application/json

Example:

```json
{
    "message": "text",
    "data": null,
    "responseCode": 400 // 500
}
```

#### Unauthorized (401)

- **Content type:** application/json

Example:

```json
{
    "code": 401,
    "message": "Invalid credentials."
}
```

## Done task `/api/task/done` [PATCH]

The `/api/task/done` method is used to mark task as complete.

### HTTP-запрос

- **Method:** PATCH
- **Required authentication:** True
- **Content type:** application/json
- **Authorization:** Bearer Token

### Request body

- **Required:** True

1. `id` (integer, min: 1)

Example:

```json
{
    "id": 2
}
```

### Responses

1. `message` (string or null)
2. `data` (object or null)

#### Success (200)

- **Content type:** application/json

Example:

```json
{
    "message": null,
    "data":
        {
            "id": 1,
            "title": "test1",
            "description": "test1",
            "createdAt": 1694921959,
            "updatedAt": null,
            "planeCompleteDate": 1700170901,
            "isComplete": true,
            "userId": 1
        },
    "responseCode": 200
}
```

#### BAD REQUEST (400), SERVER ERROR (500)

- **Content type:** application/json

Example:

```json
{
    "message": "text",
    "data": null,
    "responseCode": 400 // 500
}
```

#### Unauthorized (401)

- **Content type:** application/json

Example:

```json
{
    "code": 401,
    "message": "Invalid credentials."
}
```


## Delete task `/api/task` [DELETE]

The `/api/task` method is used to deleting task by id for current user.

### HTTP-запрос

- **Method:** DELETE
- **Required authentication:** True
- **Content type:** application/json
- **Authorization:** Bearer Token

### URI Params

- **Required:** True

1. `id` - id of task

### Responses

1. `message` (string or null)
2. `data` (object or null)

#### Success (200)

- **Content type:** application/json

Example:

```json
{
    "message": null,
    "data": null,
    "responseCode": 200
}
```

#### BAD REQUEST (400), SERVER ERROR (500)

- **Content type:** application/json

Example:

```json
{
    "message": "text",
    "data": null,
    "responseCode": 400 // 500
}
```

#### Unauthorized (401)

- **Content type:** application/json

Example:

```json
{
    "code": 401,
    "message": "Invalid credentials."
}
```


##

</details>
