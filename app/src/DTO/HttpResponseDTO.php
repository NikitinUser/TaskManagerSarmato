<?php

namespace App\DTO;

use App\DTO\Interface\ResponseDataInterface;

class HttpResponseDTO
{
    public ?string $error = null;
    public ?ResponseDataInterface $data = null;
}
