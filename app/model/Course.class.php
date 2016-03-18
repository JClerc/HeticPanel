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

    public function ofTeacher(User $user) {
        return $this->createCollection('Course', $this->database->all($this->getTable(), [
            'teacher' => $user->getId()
        ]));
    }

    public function ofTeacherAt(User $user, Date $date = null) {
        if (!isset($date)) $date = new Date;
        return $this->createCollection('Course', $this->database->all($this->getTable(), 'teacher = ? AND startdate <= ? AND enddate >= ? AND dayofweek = ?', [
            $user->getId(),
            $date->getTime(),
            $date->getTime(),
            $date->getDayOfWeek(),
        ]));
    }

    public function fromTeacherAtTime(User $user, Date $date = null, $time = null) {
        if (!isset($date)) $date = new Date;
        if (!isset($time)) $time = time();
        $time = $time % 86400;
        $this->fromEntry($this->database->get($this->getTable(), 'teacher = ? AND startdate <= ? AND enddate >= ? AND dayofweek = ? AND starttime <= ? AND endtime >= ?', [
            $user->getId(),
            $date->getTime(),
            $date->getTime(),
            $date->getDayOfWeek(),
            $time,
            $time,
        ]));
    }

    public function getGroup() {
        $group = Factory::create(new Group);
        $group->fromId($this->get('group'));
        return $group;
    }

    public function getStudents() {
        return $this->getGroup()->getStudents();
    }

    public function create($name, $code, User $teacher, Group $group, Date $startDate, Date $endDate, $startTime, $endTime, $dayofweek) {
        return $this->insert([
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
