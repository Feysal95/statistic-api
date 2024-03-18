<?php

declare(strict_types=1);

namespace App\Shared\Factory\Dto;

final class ExceptionResponseParamDto
{
    /** @param string[] $headers */
    private function __construct(
        public int $status,
        public PayloadErrorCollectionDto $errorCollection,
        public array $headers,
    ) {}

    /** @param string[] $headers */
    public static function create(int $status, PayloadErrorCollectionDto $errorCollection, array $headers = []): self
    {
        return new self($status, $errorCollection, $headers);
    }
}
