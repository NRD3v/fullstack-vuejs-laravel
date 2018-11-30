<?php

namespace Medoucine\Practice\Domain;


interface IPracticeRepository
{
    /**
     * @return array
     */
    public function findAll(): array;
}
