<?php

class Absence extends DataModel {

    const STATE_ABSENT   = 0;
    const STATE_LATE     = 1;
    const STATE_PENDING  = 2;
    const STATE_DENIED   = 3;
    const STATE_ACCEPTED = 4;

    protected $properties = [
        'student'  => 0,
        'date'     => '',
        'course'   => 0,
        'reason'   => '',
        'state'    => 0,
        'updated'  => 0,
    ];

    public function create(User $student, Day $date, Course $course) {
    
        return $this->make([
            'student'  => $student->getId(),
            'date'     => $date->toString(),
            'course'   => $course->getId(),
            'reason'   => '',
            'state'    => 0,
            'updated'  => time(),
        ]);

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
