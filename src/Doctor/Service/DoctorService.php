<?php

namespace Medoucine\Doctor\Service;

use Medoucine\Doctor\Domain\Doctor;

class DoctorService
{
    /**
     * @param array $doctor
     * @return Doctor
     */
    public function setDoctor(array $doctor): Doctor
    {
        $model = new Doctor();
        $model->setName($doctor['name']);
        $model->setCity($doctor['city']);
        $model->setPractices($doctor['practices']);
        $model->setDescription($doctor['description']);
        return $model;
    }

    /**
     * @param array $doctors
     * @return array
     */
    public function formatDoctorForJsonResponse(array $doctors): array
    {
        $formattedDoctors = [];
        /** @var Doctor $doctor */
        foreach ($doctors as $doctor) {
            array_push($formattedDoctors, [
                'name' => $doctor->getName(),
                'city' => $doctor->getCity(),
                'practice' => $doctor->getPractices(),
                'description' => $doctor->getDescription()
            ]);
        }
        return $formattedDoctors;
    }
}
