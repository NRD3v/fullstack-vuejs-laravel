<?php

namespace Medoucine\Doctor\Domain;

interface IDoctorRepository
{
    /**
     * @param string $city
     * @param string $practice
     * @return array
     */
    public function findByCityAndPractice(string $city, string $practice): array;

    /**
     * @param string $city
     * @return array
     */
    public function findByCity(string $city): array;

    /**
     * @param string $practice
     * @return array
     */
    public function findByPractice(string $practice): array;
}
