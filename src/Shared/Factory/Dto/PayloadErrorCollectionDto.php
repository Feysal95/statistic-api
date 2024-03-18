<?php

declare(strict_types=1);

namespace App\Shared\Factory\Dto;

final class PayloadErrorCollectionDto
{
    /** @var ApiPayloadErrorDto[] */
    private array $errors = [];

    /** @return ApiPayloadErrorDto[] */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function addError(ApiPayloadErrorDto $error): void
    {
        $this->errors[] = $error;
    }
}
