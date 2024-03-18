<?php

declare(strict_types=1);

namespace App\Country\Controller;

use App\Country\Service\CountryStatisticService;
use App\Country\Service\Dto\CountryStatisticUpdateDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('api/statistics/countries')]
class CountryStatisticController extends AbstractController
{
    public function __construct(private readonly CountryStatisticService $statisticsService) {}

    #[Route(name: 'list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $countries = $this->statisticsService->getAll();

        return $this->json($countries);
    }

    #[Route(name: 'update', methods: ['POST'])]
    public function update(CountryStatisticUpdateDto $requestDto): Response
    {
        $this->statisticsService->update($requestDto);

        return new Response(null, 204);
    }
}
