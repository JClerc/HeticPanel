<?php

class Group extends DataModel {

    protected $properties = [
        'index'     => 0,
        'promotion' => 0,
        'students'  => [],
        'courses'   => [],
    ];
    
    public function create($index, array $students, array $courses) {
        return $this->make([
            'index' => $index,
            'promotion' => $promotion,
            'students' => $students,
            'courses' => $courses,
        ]);
    }

    public function getStudent($id = null) {
        return $this->getCollection('Student', $id);
    }

    public function getStudents() {
        return $this->getCollection('Student');
    }

    public function hasStudent($id = null) {
        return $this->hasCollection('Student', $id);
    }

    public function addStudent($id) {
        return $this->addCollection('Student', $id);
    }

    public function removeStudent($id) {
        return $this->removeCollection('Student', $id);
    }

    public function getCourse($id = null) {
        return $this->getCollection('Course', $id);
    }

    public function getCourses() {
        return $this->getCollection('Course');
    }

    public function hasCourse($id = null) {
        return $this->hasCollection('Course', $id);
    }

    public function addCourse($id) {
        return $this->addCollection('Course', $id);
    }

    public function removeCourse($id) {
        return $this->removeCollection('Course', $id);
    }

}
