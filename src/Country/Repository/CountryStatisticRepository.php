<?php

declare(strict_types=1);

namespace App\Country\Repository;

use Predis\ClientInterface;

class CountryStatisticRepository implements CountryStatisticRepositoryInterface
{
    private const HASH_MAP_NAME = 'countries';
    private const INCR_BY = 1;

    public function __construct(private readonly ClientInterface $client) {}

    public function increment(string $countryCode): void
    {
        $this->client->hincrby(self::HASH_MAP_NAME, $countryCode, self::INCR_BY);
    }

    public function getAll(): array
    {
        return $this->client->hgetall(self::HASH_MAP_NAME);
    }
}
