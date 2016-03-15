<?php

class Absence extends DataModel {

    const STATE_ABSENT   = 0;
    const STATE_LATE     = 1;
    const STATE_PENDING  = 2;
    const STATE_DENIED   = 3;
    const STATE_ACCEPTED = 4;

    protected $properties = [
        'student'  => 0,
        'date'     => 0,
        'course'   => 0,
        'reason'   => '',
        'state'    => 0,
        'updated'  => 0,
    ];

    public function isAt(Date $date) {
        $current = Factory::create(new Date);
        $current->fromTime($this->get('date'));
        return $current->equals($date);
    }

    public function isFor(Course $course) {
        return intval($this->get('course')) === $course->getId();
    }

    public function ofStudent(User $user) {
        return $this->createCollection('Absence', $this->database->all($this->getTable(), [
            'student' => $user->getId()
        ]));
    }

    public function ofCourse(Course $course) {
        return $this->createCollection('Absence', $this->database->all($this->getTable(), [
            'course' => $course->getId()
        ]));
    }

    public function create(User $student, Date $date, Course $course) {
        return $this->make([
            'student'  => $student,
            'date'     => $date->getTime(),
            'course'   => $course,
            'reason'   => '',
            'state'    => 0,
            'updated'  => time(),
        ]);
    }

    public function getDate() {
        $date = new Date;
        $date->fromTime($this->get('date'));
        return $date;
    }

    public function getCourse() {
        $course = Factory::create(new Course);
        $course->fromId($this->get('course'));
        return $course;
    }

    public function changeToLate() {
        $this->set('state', self::STATE_LATE);
        $this->set('updated', time());
    }

    public function addReason($reason) {
        $this->set('reason', $reason);
        $this->set('state', self::STATE_PENDING);
        $this->set('updated', time());
    }

    public function acceptReason() {
        $this->set('state', self::STATE_ACCEPTED);
        $this->set('updated', time());
    }

    public function denyReason() {
        $this->set('state', self::STATE_DENIED);
        $this->set('updated', time());
    }

}
