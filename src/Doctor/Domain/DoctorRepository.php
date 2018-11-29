<?php

namespace Medoucine\Doctor\Domain;

use Medoucine\Doctor\Service\DoctorService;

class DoctorRepository implements IDoctorRepository
{
    /**
     * @var DoctorService
     */
    private $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    /**
     * @param string $city
     * @param string $practice
     * @return array
     */
    public function findDoctorsByCityAndPractice(string $city, string $practice): array
    {
        $foundDoctors = [];
        $file = file_get_contents(config('file.path.database'));
        $doctorsList = json_decode($file, true);
        foreach ($doctorsList as $doctor) {
            if ($doctor) {
                if ($doctor['city'] === $city && in_array($practice, $doctor['practices'])) {
                    array_push($foundDoctors, $this->doctorService->setDoctor($doctor));
                }
            }
        }
        return $foundDoctors;
    }

    /**
     * @param string $city
     * @return array
     */
    public function findDoctorsByCity(string $city): array
    {
        $foundDoctors = [];
        $file = file_get_contents(config('file.path.database'));
        $doctorsList = json_decode($file, true);
        foreach ($doctorsList as $doctor) {
            if ($doctor) {
                if ($doctor['city'] === $city) {
                    array_push($foundDoctors, $this->doctorService->setDoctor($doctor));
                }
            }
        }
        return $foundDoctors;
    }

    /**
     * @param string $practice
     * @return array
     */
    public function findDoctorsByPractice(string $practice): array
    {
        $foundDoctors = [];
        $file = file_get_contents(config('file.path.database'));
        $doctorsList = json_decode($file, true);
        foreach ($doctorsList as $doctor) {
            if ($doctor) {
                if (in_array($doctor['practices'], [$practice])) {
                    array_push($foundDoctors, $this->doctorService->setDoctor($doctor));
                }
            }
        }
        return $foundDoctors;
    }
}
