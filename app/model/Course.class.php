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

    public function fromTeacherGroupAt(User $user, Group $group, Date $date = null) {
        if (!isset($date)) $date = new Date;

        $this->fromEntry($this->database->get($this->getTable(), 'teacher = ? AND startdate <= ? AND enddate >= ? AND dayofweek = ? AND `group` = ?', [
            $user->getId(),
            $date->getTime(),
            $date->getTime(),
            $date->getDayOfWeek(),
            $group->getId(),
        ]));
    }

    public function fromTeacherAtTime(User $user, Date $date = null, $time = TIME) {
        if (!isset($date)) $date = new Date;
        if (!isset($time)) $time = TIME;
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

    public function getTeacher() {
        $teacher = Factory::create(new User);
        $teacher->fromId($this->get('teacher'));
        return $teacher;
    }

    public function getStudents() {
        return $this->getGroup()->getStudents();
    }

    public function validate($name, $code, User $teacher, Group $group, Date $startDate, Date $endDate, $startTime, $endTime, $dayofweek) {

        Validate::min($name, 3, 'Le nom du cours est trop court.');
        Validate::max($name, 50, 'Le nom du cours est trop long.');

        Validate::notEmpty($code, 'Le code du cours est incorrect.');

        Validate::exists($teacher, 'Le professeur n\'existe pas.');

        Validate::exists($group, 'Le groupe n\'existe pas.');

        Validate::exists($startDate, 'La date est incorrecte.');
        Validate::exists($endDate, 'La date est incorrecte.');

        Validate::between($startTime, [0, 86400], 'L\'heure est incorrecte.');
        Validate::between($endTime, [0, 86400], 'L\'heure est incorrecte.');

        Validate::between($dayofweek, [1, 7], 'Le jour est incorrect.');

    }

    public function create($name, $code, User $teacher, Group $group, Date $startDate, Date $endDate, $startTime, $endTime, $dayofweek) {

        $this->validate($name, $code, $teacher, $group, $startDate, $endDate, $startTime, $endTime, $dayofweek);

        $r = $this->insert([
            'name'      => $name,
            'code'      => $code,
            'teacher'   => $teacher,
            'group'     => $group,
            'startdate' => $startDate->getTime(),
            'enddate'   => $endDate->getTime(),
            'starttime' => $startTime,
            'endtime'   => $endTime,
            'dayofweek' => $dayofweek,
        ]);

        if ($r) {
            $group = $this->getGroup();
            $group->addCourse($this);
            $group->save();
        }

        return $r;

    }

    protected function onDelete() {
        $groups = Group::make()->find();
        foreach ($groups as $group) {
            if ($group->hasCourse($this)) {
                $group->removeCourse($this);
                $group->save();
            }
        }
    }

    protected function onSave() {
        $this->onDelete();
        $group = $this->getGroup();
        $group->addCourse($this);
        $group->save();
    }

    public static function sort($list) {
        usort($list, function ($a, $b) { 
            $diff = $a->get('dayofweek') - $b->get('dayofweek');
            if ($diff) return $diff;
            return $a->get('starttime') - $b->get('starttime');
        });
        return $list;
    }

}
