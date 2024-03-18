<?php

declare(strict_types=1);

namespace App\Country\Repository;

interface CountryStatisticRepositoryInterface
{
    public function increment(string $countryCode): void;

    /** @return array<string, string> */
    public function getAll(): array;
}
