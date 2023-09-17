<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UpdateTaskRequest
{
    private ValidatorInterface $validator;
    
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(array $data): array
    {
        $validateResult = $this->validator->validate($data, $this->getConstraint());

        if (count($validateResult)) {
            $errors = [];
            foreach ($validateResult as $error) {
                $field = $error->getPropertyPath();
                $errors[$field] = $error->getMessage();
            }

            $errorsText = array_map(function ($name, $value) {
                return $name . " " . $value;
            }, array_keys($errors), $errors);

            $errorsText = implode(', ', $errorsText);

            throw new BadRequestHttpException($errorsText);
        }

        return $data;
    }
    
    private function getConstraint(): Assert\Collection
    {
        $fields = [
            'fields' => [
                'id' => new Assert\Required([
                    new Assert\NotBlank(),
                    new Assert\Type(["type" => "integer"]),
                    new Assert\Length(["min" => 1])
                ]),
                'title' => new Assert\Required([
                    new Assert\NotBlank(),
                    new Assert\Type(["type" => "string"]),
                    new Assert\Length(["min" => 1, "max" => 127]),
                    new Assert\Regex(["pattern" => '/^[A-Za-z А-Яа-яЁё 0-9]+$/u'])
                ]),
                'description' => new Assert\Required([
                    new Assert\NotBlank(),
                    new Assert\Type(["type" => "string"]),
                    new Assert\Length(["min" => 1, "max" => 2500]),
                    new Assert\Regex(["pattern" => '/^[A-Za-z А-Яа-яЁё 0-9]+$/u'])
                ]),
                'planeCompliteDate' => new Assert\Required([
                    new Assert\NotBlank(),
                    new Assert\Type(["type" => "integer"]),
                    new Assert\Length(["min" => 10, "max" => 10])
                ])
            ],
            'allowExtraFields' => false
        ];
        return new Assert\Collection($fields);
    }
}
