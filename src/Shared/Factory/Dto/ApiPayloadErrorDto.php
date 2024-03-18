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
    private function __construct(
        public int $status,
        public string $title,
        public string $detail,
        public ?array $meta,
        public ?string $field,
    ) {}

    /**
     * @param ?array{
     *     file: string,
     *     line: int,
     *     trace: string,
     * } $meta
     */
    public static function create(
        int $status,
        string $title,
        string $detail,
        ?array $meta = null,
        ?string $field = null,
    ): self {
        return new self($status, $title, $detail, $meta, $field);
    }
}
