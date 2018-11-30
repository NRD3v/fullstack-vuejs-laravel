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
    public function findByCityAndPractice(string $city, string $practice): array
    {
        $result = [];
        $file = file_get_contents(config('file.path.database'));
        $doctorsList = json_decode($file, true);
        foreach ($doctorsList as $doctor) {
            if ($doctor) {
                if ($doctor['city'] === $city && in_array($practice, $doctor['practices'])) {
                    array_push($result, $this->doctorService->setDoctor($doctor));
                }
                unset($doctor);
            }
        }
        unset($file, $doctorsList);
        return $result;
    }

    /**
     * @param string $city
     * @return array
     */
    public function findByCity(string $city): array
    {
        $result = [];
        $file = file_get_contents(config('file.path.database'));
        $doctorsList = json_decode($file, true);
        foreach ($doctorsList as $doctor) {
            if ($doctor) {
                if ($doctor['city'] === $city) {
                    array_push($result, $this->doctorService->setDoctor($doctor));
                }
                unset($doctor);
            }
        }
        unset($file, $doctorsList);
        return $result;
    }

    /**
     * @param string $practice
     * @return array
     */
    public function findByPractice(string $practice): array
    {
        $result = [];
        $file = file_get_contents(config('file.path.database'));
        $doctorsList = json_decode($file, true);
        foreach ($doctorsList as $doctor) {
            if ($doctor) {
                if (in_array($practice, $doctor['practices'])) {
                    array_push($result, $this->doctorService->setDoctor($doctor));
                }
                unset($doctor);
            }
        }
        unset($file, $doctorsList);
        return $result;
    }
}
