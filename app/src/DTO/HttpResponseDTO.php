<?php

namespace App\DTO;

use App\DTO\Interface\ResponseDataInterface;
use Symfony\Component\HttpFoundation\Response;

class HttpResponseDTO
{
    public null | string | array $error = null;
    public null | array | ResponseDataInterface $data = null;
    public int $responseCode = Response::HTTP_OK;
}
