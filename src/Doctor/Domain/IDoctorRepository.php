<?php

namespace Medoucine\Doctor\Domain;

interface IDoctorRepository
{
    /**
     * @param string $city
     * @param string $practice
     * @return array
     */
    public function findDoctorsByCityAndPractice(string $city, string $practice): array;

    /**
     * @param string $city
     * @return array
     */
    public function findDoctorsByCity(string $city): array;

    /**
     * @param string $practice
     * @return array
     */
    public function findDoctorsByPractice(string $practice): array;
}
