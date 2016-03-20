<?php

class Group extends DataModel {

    protected $properties = [
        'index'     => 0,
        'promotion' => 0,
        'students'  => [],
        'courses'   => [],
    ];


    public function validate($index, Promotion $promotion, array $students = [], array $courses = []) {

        Validate::min($index, 1, 'L\'index est incorrect.');

        Validate::exists($promotion, 'La promotion n\'existe pas.');

        Validate::isEmpty(Group::find([
            'index' => $index,
            'promotion' => $promotion->getId()
        ]), 'Un groupe avec cette index existe déjà.');

        Validate::isArray($students, 'La liste des étudiants est incorrecte.');
        Validate::isArray($courses, 'La liste des cours est incorrecte.');

    }

    public function create($index, Promotion $promotion, array $students = [], array $courses = []) {

        $this->validate($index, $promotion, $students, $courses);
    
        return $this->insert([
            'index' => $index,
            'promotion' => $promotion,
            'students' => $students,
            'courses' => $courses,
        ]);
    }

    public function getIndex() {
        return $this->get('index');
    }

    public function getPromotion() {
        return Promotion::make($this->get('promotion'));
    }

    public function getStudent($id = null) {
        return $this->getCollection(['User', 'students'], $id);
    }

    public function getStudents() {
        return $this->getCollection(['User', 'students']);
    }

    public function hasStudent($id = null) {
        return $this->hasCollection(['User', 'students'], $id);
    }

    public function addStudent($id) {
        return $this->addCollection(['User', 'students'], $id);
    }

    public function removeStudent($id) {
        return $this->removeCollection(['User', 'students'], $id);
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

    public static function sort($list) {
        usort($list, function ($a, $b) { 
            $diff = $a->getPromotion()->getYear() - $b->getPromotion()->getYear();
            if ($diff) return $diff;
            return $a->getIndex() - $b->getIndex(); 
        });
        return $list;
    }

    protected function onDelete() {
        $promotions = Promotion::make()->find();
        foreach ($promotions as $promotion) {
            if ($promotion->hasGroup($this)) {
                $promotion->removeGroup($this);
                $promotion->save();
            }
        }
    }
    
    protected function onSave() {
        $this->onDelete();
        $promotion = $this->getPromotion();
        $promotion->addGroup($this);
        $promotion->save();
    }

}
