<?php

class Course extends DataModel {

    protected $properties = [
        'name'      => '',
        'code'      => '',
        'teacher'   => 0,
        'group'     => 0,
        'startdate' => 0,
        'enddate'   => 0,
        'starttime' => 0,
        'endtime'   => 0,
        'dayofweek' => 0,
    ];

    public function create($name, $code, User $teacher, Group $group, Date $startDate, Date $endDate, $startTime, $endTime, $dayofweek) {
        return $this->make([
            'name'      => $name,
            'code'      => $code,
            'teacher'   => $teacher,
            'group'     => $group,
            'startdate' => $start->getTime(),
            'enddate'   => $end->getTime(),
            'starttime' => $startTime,
            'endtime'   => $endTime,
            'dayofweek' => $dayofweek,
        ]);
    }

}
