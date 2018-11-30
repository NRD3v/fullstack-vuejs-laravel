<?php

namespace Medoucine\City\Domain;

interface ICityRepository
{
    /**
     * @return array
     */
    public function findAll(): array;
}
