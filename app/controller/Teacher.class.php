<?php

class TeacherController extends Controller {

    const DEPENDENCIES = ['Auth', 'Flash', 'Router'];

    const PERMISSION_REQUIRED = User::TEACHER;

    public function index($request) {}

    public function roll($request) {
        $result = $this->processStudents();
        $this->set('date', new Date);
        if (POST) {
            if ($result) {
                $this->flash->set(true, 'Feuille d\'appel sauvegardée !');
            } else {
                $this->flash->set(false, 'Impossible de sauvegarder la feuille d\'appel..');
            }
            $this->router->go('teacher');
        }
    }

    public function course($request) {
        $result = $this->processStudents();
        $this->set('date', new Date);
        if (POST) {
            if ($result) {
                $this->flash->set(true, 'Feuille d\'appel sauvegardée !');
            } else {
                $this->flash->set(false, 'Impossible de sauvegarder la feuille d\'appel..');
            }
        }
    }

    private function processStudents() {

        $course = Course::make();
        $course->fromTeacherAtTime($this->auth->current());

        if ($course->exists()) {

            $students = $course->getStudents();
            
            if (!empty($students)) {

                $students = User::sort($students);
                $absences = Absence::make()->ofCourseAt($course);

                if (POST) {
                    $sendedAbsences = isset($_POST['absences']) ? $_POST['absences'] : [];
                    $date = new Date;
                    $removeAbsences = $absences;
                    foreach ($sendedAbsences as $absent) {
                        $id = intval($absent);
                        if ($id > 0) {
                            $found = false;
                            $student = User::make($id);
                            foreach ($removeAbsences as $key => $removeAbsence) {
                                if ($removeAbsence->isFor($student)) {
                                    unset($removeAbsences[$key]);
                                    $found = true;
                                    break;
                                }
                            }
                            if (!$found) {
                                $absence = Absence::make();
                                $absence->create($student, $date, $course);
                            }
                        }
                    }
                    foreach ($removeAbsences as $removeAbsence) {
                        $removeAbsence->delete();
                    }
                }

                // Refresh addition and deletion
                $absences = Absence::make()->ofCourseAt($course);

                $list = [];
                $i = 0;

                foreach ($students as $student) {
                    $absent = false;
                    foreach ($absences as $absence) {
                        $absent = ($absent or $absence->isFor($student));
                    }
                    $list[] = [
                        'user' => $student,
                        'absent' => $absent,
                        'class' => $i === 0 ? 'current' : ($i === 1 ? 'next' : ''),
                        'index' => $i++,
                    ];
                }

                $this->set('students', $list);

                return true;

            }
        }

        $this->flash->set(false, 'Vous ne présentez aucun cours en ce moment.');
        $this->router->go('teacher');

        return false;

    }

}
