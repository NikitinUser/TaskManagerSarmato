<?php

namespace App\DTO;

use App\DTO\Interface\ResponseDataInterface;

class HttpResponseDTO
{
    public null | string | array $error = null;
    public null | array | ResponseDataInterface $data = null;
}
