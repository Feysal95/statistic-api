<?php

declare(strict_types=1);

namespace App\Shared\Factory\Dto;

final class ApiPayloadErrorDto
{
    /**
     * @param ?array{
     *     file: string,
     *     line: int,
     *     trace: string,
     * } $meta
     */
    public function __construct(
        public int $status,
        public string $title,
        public string $detail,
        public ?array $meta = null,
    ) {}
}
