<?php

declare(strict_types=1);

namespace App\Country\Service;

use App\Country\Exception\CountryStaticGetException;
use App\Country\Exception\CountryStaticUpdateException;
use App\Country\Repository\CountryStatisticRepositoryInterface;
use App\Country\Service\Dto\CountryStatisticUpdateDto;
use Psr\Log\LoggerInterface;
use Throwable;

readonly class CountryStatisticService
{
    public function __construct(
        private CountryStatisticRepositoryInterface $statisticsRepository,
        private LoggerInterface $logger,
    ) {}

    /** @return array<string, string> */
    public function getAll(): array
    {
        try {
            return $this->statisticsRepository->getAll();
        } catch (Throwable $exception) {
            $this->logger->error('Failed to get country statistics', [
                'reason' => $exception->getMessage(),
            ]);

            throw new CountryStaticGetException($exception->getMessage(), $exception);
        }
    }

    public function update(CountryStatisticUpdateDto $countryStatisticUpdateDto): void
    {
        try {
            $this->statisticsRepository->increment($countryStatisticUpdateDto->getCode());
        } catch (Throwable $exception) {
            $this->logger->error('Failed to update country statistics', [
                'reason' => $exception->getMessage(),
                'countryCode' => $countryStatisticUpdateDto->getCode(),
            ]);

            throw new CountryStaticUpdateException($exception->getMessage(), $exception);
        }
    }
}
