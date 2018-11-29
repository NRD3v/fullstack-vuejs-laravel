<?php

namespace Medoucine\Doctor\Domain;

class Doctor
{
    private $name;
    private $city;
    private $practices;
    private $description;

    public function __construct() {}

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return array
     */
    public function getPractices(): array
    {
        return $this->practices;
    }

    /**
     * @param array $practices
     */
    public function setPractices(array $practices): void
    {
        $this->practices = $practices;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
