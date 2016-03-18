<?php

class TeacherController extends Controller {

    const DEPENDENCIES = ['Auth'];

    // Students doesnt have a panel
    const PERMISSION_REQUIRED = User::TEACHER;

    public function index($request) {}

    public function course($request) {

        $course = Course::make();
        $course->fromTeacherAtTime($this->auth->current());

        if ($course->exists()) {

            $students = $course->getStudents();
            $students = User::sortByLastName($students);
        }

        if (POST) {
            if (isset($post['absences'])) {
                if ($this->updateAbsences($post['absences'])) {

                } else {

                }
            }
        }

    }

    private function updateAbsences($absences) {
        $result = true;
        foreach ($absences as $absent) {
            $id = intval($absent);
            if ($id > 0) {
                $student = User::make($id);
            }
        }
        return $result;
    }

}
