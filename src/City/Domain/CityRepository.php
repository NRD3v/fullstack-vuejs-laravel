<?php

namespace Medoucine\City\Domain;

class CityRepository implements ICityRepository
{
    /**
     * @return array
     */
    public function findAll(): array
    {
        $result = [];
        $file = file_get_contents(config('file.path.database'));
        $doctorsList = json_decode($file, true);
        foreach ($doctorsList as $doctor) {
            if ($doctor) {
                if (in_array($doctor['city'], $result)) {
                    next($doctor);
                } else {
                    array_push($result, $doctor['city']);
                }
                unset($doctor);
            }
        }
        unset($file, $doctorsList);
        return $result;
    }
}
