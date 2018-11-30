<?php

namespace App\Http\Controllers;

use Medoucine\City\Domain\ICityRepository;
use Medoucine\Doctor\Domain\IDoctorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medoucine\Doctor\Service\DoctorService;
use Medoucine\Practice\Domain\IPracticeRepository;

class SearchController
{
    private const SEARCH_BY_CITY_AND_PRACTICE = "search_by_city_and_practice";
    private const SEARCH_BY_CITY = "search_by_city";
    private const SEARCH_BY_PRACTICE = "search_by_practice";

    /**
     * @var ICityRepository
     */
    private $cityRepository;

    /**
     * @var IDoctorRepository
     */
    private $doctorRepository;

    /**
     * @var DoctorService
     */
    private $doctorService;

    /**
     * @var IPracticeRepository
     */
    private $practiceRepository;

    /**
     * SearchController constructor.
     * @param DoctorService $doctorService
     * @param ICityRepository $cityRepository
     * @param IDoctorRepository $doctorRepository
     * @param IPracticeRepository $practiceRepository
     */
    public function __construct(
        DoctorService $doctorService,
        ICityRepository $cityRepository,
        IDoctorRepository $doctorRepository,
        IPracticeRepository $practiceRepository
    ) {
        $this->cityRepository = $cityRepository;
        $this->doctorService = $doctorService;
        $this->doctorRepository = $doctorRepository;
        $this->practiceRepository = $practiceRepository;
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
                            $doctors = $this->doctorRepository->findByCityAndPractice($city, $practice);
                            $response['doctors'] = $this->doctorService->formatDoctorForJsonResponse($doctors);
                        }
                        break;
                    }
                    case $searchType === static::SEARCH_BY_CITY: {
                        if ($city) {
                            $doctors = $this->doctorRepository->findByCity($city);
                            $response['doctors'] = $this->doctorService->formatDoctorForJsonResponse($doctors);
                        }
                        break;
                    }
                    case $searchType === static::SEARCH_BY_PRACTICE: {
                        if ($practice) {
                            $doctors = $this->doctorRepository->findByPractice($practice);
                            $response['doctors'] = $this->doctorService->formatDoctorForJsonResponse($doctors);
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
        return response()->json($this->practiceRepository->findAll());
    }
}
