<?php

declare(strict_types=1);

namespace App\Shared\Service;

use App\Shared\Exception\ConstraintValidationErrorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class ValidatorService
{
    public function __construct(private ValidatorInterface $validator) {}

    public function validate(object $dto): void
    {
        $constraints = $this->validator->validate($dto);

        if ($constraints->count() !== 0) {
            throw new ConstraintValidationErrorException($constraints);
        }
    }
}
