<?php

declare(strict_types=1);

namespace App\Shared\Factory\Dto;

final class ExceptionResponseParamDto
{
    /**
     * @param array<ApiPayloadErrorDto> $errors
     * @param array<string> $headers
     */
    private function __construct(
        public int $status,
        public array $errors,
        public array $headers,
    ) {}

    /**
     * @param array<ApiPayloadErrorDto> $errors
     * @param array<string> $headers
     */
    public static function create(int $status, array $errors, array $headers = []): self
    {
        return new self($status, $errors, $headers);
    }
}
