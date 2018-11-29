<?php

namespace App\Http\Controllers;

use Medoucine\Doctor\Domain\IDoctorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medoucine\Doctor\Service\DoctorService;

class SearchController
{
    private const SEARCH_BY_CITY_AND_PRACTICE = "search_by_city_and_practice";
    private const SEARCH_BY_CITY = "search_by_city";
    private const SEARCH_BY_PRACTICE = "search_by_practice";

    /**
     * @var IDoctorRepository
     */
    private $doctorRepository;

    /**
     * @var DoctorService
     */
    private $doctorService;

    /**
     * SearchController constructor.
     * @param DoctorService $doctorService
     * @param IDoctorRepository $doctorRepository
     */
    public function __construct(DoctorService $doctorService, IDoctorRepository $doctorRepository)
    {
        $this->doctorService = $doctorService;
        $this->doctorRepository = $doctorRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $response = [];
        $searchType = $request->get('search_type');
        $city = $request->json()->get('city');
        $practice = $request->json()->get('practice');
        try {
            if ($searchType) {
                switch ($searchType) {
                    case $searchType === static::SEARCH_BY_CITY_AND_PRACTICE: {
                        if ($city && $practice) {
                            $doctors = $this->doctorRepository->findDoctorsByCityAndPractice($city, $practice);
                            $response = $this->doctorService->formatDoctorForJsonResponse($doctors);
                        }
                        break;
                    }
                    case $searchType === static::SEARCH_BY_CITY: {
                        if ($city) {
                            $doctors = $this->doctorRepository->findDoctorsByCity($city);
                            $response = $this->doctorService->formatDoctorForJsonResponse($doctors);
                        }
                        break;
                    }
                    case $searchType === static::SEARCH_BY_PRACTICE: {
                        if ($practice) {
                            $doctors = $this->doctorRepository->findDoctorsByPractice($practice);
                            $response = $this->doctorService->formatDoctorForJsonResponse($doctors);
                        }
                        break;
                    }
                    default: {
                        break;
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
        return response()->json($response);
    }
}
