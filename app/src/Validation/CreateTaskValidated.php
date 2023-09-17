<?php

namespace App\Validation;

use Symfony\Component\Validator\Constraints as Assert;

class CreateTaskValidated implements ValidatedTaskInterface
{
    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    #[Assert\Length(max: 255)]
    #[Assert\Regex('/^[A-Za-z А-Яа-яЁё 0-9]+$/u')]
    public $title;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    #[Assert\Length(max: 2500)]
    #[Assert\Regex('/^[A-Za-z А-Яа-я 0-9]+$/u')]
    public $description;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'integer')]
    #[Assert\Length(max: 10, min:10)]
    public $planeCompliteDate;
}
