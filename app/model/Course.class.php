<?php

class Course extends DataModel {

    protected $properties = [
        'name'      => '',
        'code'      => '',
        'teacher'   => 0,
        'group'     => 0,
        'start'     => '',
        'end'       => '',
        'dayofweek' => 0,
    ];

    public function create($name, $code, User $teacher, Group $group, Day $start, Day $end, $dayofweek) {
    
        return $this->make([
            'name'      => $name,
            'code'      => $code,
            'teacher'   => $teacher->getId(),
            'group'     => $group->getId(),
            'start'     => $start->toString(),
            'end'       => $end->toString(),
            'dayofweek' => $dayofweek,
        ]);

    }

}
