<?php

class Absence extends DataModel {

    const STATE_ABSENT   = 0;
    const STATE_LATE     = 1;
    const STATE_PENDING  = 2;
    const STATE_DENIED   = 3;
    const STATE_ACCEPTED = 4;

    const PHP_PROOF_DIR = APP . 'upload/';
    const HTTP_PROOF_DIR = HTTP_ROOT . 'app/upload/';

    protected $properties = [
        'student'    => 0,
        'date'       => 0,
        'course'     => 0,
        'reason'     => '',
        'state'      => 0,
        'updated'    => 0,
        'denyreason' => '',
    ];

    public function isAt(Date $date) {
        $current = Factory::create(new Date);
        $current->fromTime($this->get('date'));
        return $current->equals($date);
    }

    public function isIn(Course $course) {
        return intval($this->get('course')) === $course->getId();
    }

    public function isFor(User $user) {
        return intval($this->get('student')) === $user->getId();
    }

    public function ofStudentInCourse(User $user, Course $course) {
        return $this->createCollection('Absence', $this->database->all($this->getTable(), [
            'student' => $user->getId(),
            'course' => $course->getId()
        ]));
    }

    public function ofStudentInCourseAt(User $user, Course $course, Date $date = null) {
        if (!isset($date)) $date = new Date;
        $row = $this->database->get($this->getTable(), [
            'student' => $user->getId(),
            'course' => $course->getId(),
            'date' => $date->getTime(),
        ]);
        if (!empty($row)) {
            $this->fromEntry($row);
        }
    }

    public function ofCourseAt(Course $course, Date $date = null) {
        if (!isset($date)) $date = new Date;
        return $this->createCollection('Absence', $this->database->all($this->getTable(), [
            'course' => $course->getId(),
            'date' => $date->getTime(),
        ]));
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
        return $this->insert([
            'student'    => $student,
            'date'       => $date->getTime(),
            'course'     => $course,
            'reason'     => '',
            'state'      => 0,
            'updated'    => TIME,
            'denyreason' => ''
        ]);
    }

    public function getImagePath() {
        $img = self::PHP_PROOF_DIR . $this->getId() . '.jpg';
        return is_file($img) ? $img : false;
    }

    public function getImageSrc() {
        return $this->getImagePath() ? self::HTTP_PROOF_DIR . $this->getId() . '.jpg' : false;
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

    public function getStudent() {
        $student = Factory::create(new User);
        $student->fromId($this->get('student'));
        return $student;
    }

    public function isResolved() {
        $state = intval($this->get('state'));
        return ($state === self::STATE_LATE or $state === self::STATE_ACCEPTED);
    }

    public function changeToLate() {
        $this->set('state', self::STATE_LATE);
        $this->set('updated', TIME);
        $this->save();
    }

    public function addReason($reason) {
        $this->set('reason', $reason);
        $this->set('state', self::STATE_PENDING);
        $this->set('updated', TIME);
        $this->save();
    }

    public function acceptReason() {
        $this->set('state', self::STATE_ACCEPTED);
        $this->set('updated', TIME);
        $this->set('denyreason', '');
        $this->save();
        $this->deleteProof();
    }

    public function denyReason($reason = '') {
        $this->set('state', self::STATE_DENIED);
        $this->set('updated', TIME);
        $this->set('denyreason', $reason);
        $this->save();
        $this->deleteProof();
    }

    public static function sort($list) {
        usort($list, function ($a, $b) {
            return $b->get('updated') - $a->get('updated');
        });
        return $list;
    }

    public function deleteProof() {
        $saveTo = Absence::PHP_PROOF_DIR . $absence->getId();
        if (is_file($saveTo . '.jpg')) {
            unlink($saveTo . '.jpg');
        }
    }

}
