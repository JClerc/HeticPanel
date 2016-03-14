<?php

class Group extends Model {

    protected $properties = [
        'index'     => 0,
        'promotion' => 0,
        'students'  => [],
        'courses'   => [],
    ];
    
    public function create($index, array $students, array $courses) {

        $ids = [];
        foreach ($students as $student) {
            $ids[] = $student->getId();
        }

        return $this->make([
            'index' => $index,
            'promotion' => $promotion->getId(),
            'students' => implode(',', $ids),
            'courses' => implode(',', $ids),
        ]);

    }

    private function setProperty($key, $value) {
        if ($key === 'students') {
            $students = explode(',', $value);
            $value = [];
            foreach ($students as $id) {
                $student = new User;
                $value[] = $student->fromId($id);
            }
        }
        parent::setProperty($key, $value);
    }

    public function hasStudent(User $student) {
        foreach ($this->students as $value) {
            if ($student->equals($value)) {
                return true;
            }
        }
        return false;
    }

    public function getStudents() {
        return $this->students;
    }

    public function addStudent(Student $student) {
        $this->removeStudent($student);
        $this->students[] = $student;
    }

    public function removeStudent(User $student) {
        foreach ($this->students as $value) {
            if ($student->equals($value)) {
                unset($this->students[$key]);
                return true;
            }
        }
        return false;
    }

    public function getIndex() {
        return $this->index;
    }

}
