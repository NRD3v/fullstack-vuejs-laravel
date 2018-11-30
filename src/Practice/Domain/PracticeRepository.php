<?php

namespace Medoucine\Practice\Domain;


class PracticeRepository implements IPracticeRepository
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
                foreach ($doctor['practices'] as $practice) {
                    if (in_array($practice, $result)) {
                        next($doctor['practices']);
                    } else {
                        array_push($result, $practice);
                    }
                }
                unset($doctor);
            }
        }
        unset($file, $doctorsList);
        return $result;
    }
}
