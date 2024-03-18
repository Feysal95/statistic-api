<?php

declare(strict_types=1);

namespace App\Country\Service\Dto;

use Symfony\Component\Validator\Constraints as Assert;

readonly class CountryStatisticUpdateDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[Assert\Country]
        private mixed $code,
    ) {}

    public function getCode(): string
    {
        return $this->code;
    }
}
