<?php

namespace Medoucine\City\Domain;

class City
{
    private $name;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }
}
