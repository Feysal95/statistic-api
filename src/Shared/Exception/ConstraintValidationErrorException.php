<?php

declare(strict_types=1);

namespace App\Shared\Exception;

use Exception;
use JsonException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ConstraintValidationErrorException extends Exception
{
    /** @throws JsonException */
    public function __construct(ConstraintViolationListInterface $errors, int $code = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        $data = [];

        foreach ($errors as $error) {
            $data[$error->getPropertyPath()][] = $error->getMessage();
        }

        parent::__construct(json_encode($data, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $code);
    }
}
