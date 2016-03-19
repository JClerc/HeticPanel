<?php

class PanelController extends Controller {

    const DEPENDENCIES = ['Database', 'Flash'];

    const PERMISSION_REQUIRED = User::STAFF;

    public function index() {}
    
    public function justify() {

        if (POST) {
            $action = $_POST['action'];
            $id = intval($_POST['id']);

            $edited = false;

            if ($id > 0) {
                $absence = Absence::make($id);
                if ($absence->exists()) {
                    if ($action === 'deny') {
                        $absence->denyReason();
                        $this->flash->set(true, 'La justification a été refusée.');
                        $edited = true;
                    } else if ($action === 'accept') {
                        $absence->acceptReason();
                        $this->flash->set(true, 'La justification a été acceptée.');
                        $edited = true;
                    }
                }
            }

            if (!$edited) {
                $this->flash->set(false, 'Impossible de modifier l\'absence..');
            }

        }

        $absences = Absence::make()->find(['state' => Absence::STATE_PENDING]);

        usort($absences, function ($a, $b) {
            return $b->get('updated') - $a->get('updated');
        });

        $this->set('absences', $absences);

    }
    
    public function course() {

        $this->selectCourse(function ($promotion, $group, $course, $teacher, $date) {
            $this->processStudents($teacher, $group, $date);
        });

    }
    
    public function cancel() {
        
        $this->selectCourse(function ($promotion, $group, $course, $teacher, $date) {
            
            if (POST and isset($_POST['cancel']) and $_POST['cancel'] === 'true') {
                $this->set('cancel', true);
                $absences = Absence::make()->ofCourseAt($course, $date);
                foreach ($absences as $absence) {
                    $absence->delete();
                }
            } else {
                $this->set('cancel', false);
            }

        });

    }

    public function admin() {
        
    }

    private function selectCourse($callback) {

        $selected = [
            'promotion' => false,
            'group'     => false,
            'course'    => false,
            'date'      => false,
        ];

        $relativeDate = [
            'prev' => false,
            'next' => false,
        ];

        // Get promotions
        $promotions = Promotion::make()->find();
        uasort($promotions, function ($a, $b) { return $a->getYear() - $b->getYear(); });
        $this->set('promotions', $promotions);

        if (POST and isset($_POST['promotion'])) {
            $promotion = Promotion::make($_POST['promotion']);

            if ($promotion->exists()) {
                $selected['promotion'] = $promotion;

                $groups = $promotion->getGroups();
                uasort($groups, function ($a, $b) { return $a->getIndex() - $b->getIndex(); });
                $this->set('groups', $groups);

                if (isset($_POST['group'])) {

                    $group = Group::make($_POST['group']);
                    if ($group->exists()) {
                        $selected['group'] = $group;

                        $courses = $group->getCourses();
                        uasort($courses, function ($a, $b) { return $a->get('dayofweek') - $b->get('dayofweek'); });
                        $this->set('courses', $courses);

                        if (isset($_POST['course'])) {

                            $course = Course::make($_POST['course']);
                            if ($course->exists()) {
                                $selected['course'] = $course;

                                $date = new Date;
                                if (isset($_POST['date'])) {
                                    $findDate = new Date;
                                    $findDate->fromString($_POST['date']);
                                    if ($findDate->exists()) {
                                        $date = $findDate;
                                    }
                                }

                                $offset = $date->getDayOfWeek() - $course->get('dayofweek');

                                while ($offset < 0) $offset += 7;

                                $date = $date->getBefore($offset);

                                $endDate = new Date;
                                $endDate->fromTime($course->get('enddate'));

                                $startDate = new Date;
                                $startDate->fromTime($course->get('startdate'));

                                if ($date->isAfter($endDate)) {
                                    $date = $endDate;
                                }

                                if ($date->isBefore($startDate)) {
                                    $date = $startDate;
                                }

                                $dateAfter = $date->getAfter(7);
                                $dateBefore = $date->getBefore(7);

                                if (!$dateBefore->isBefore($startDate)) {
                                    $relativeDate['prev'] = $dateBefore;
                                }

                                if (!$dateAfter->isAfter($endDate) and !$dateAfter->isAfter(new Date)) {
                                    $relativeDate['next'] = $dateAfter;
                                }

                                $selected['date'] = $date;
                                $teacher = $course->getTeacher();

                                if (is_callable($callback)) {
                                    $callback($promotion, $group, $course, $teacher, $date);
                                }

                            }
                        }

                    }
                }

            }
        }

        $this->set('selected', $selected);
        $this->set('relative-date', $relativeDate);

    }

    private function processStudents(User $teacher, Group $group, Date $date) {

        $course = Course::make();
        $course->fromTeacherGroupAt($teacher, $group, $date);

        if ($course->exists()) {

            $students = $course->getStudents();
            
            if (!empty($students)) {

                $students = User::sortByLastName($students);
                $absences = Absence::make()->ofCourseAt($course, $date);

                if (POST and isset($_POST['method']) and $_POST['method'] === 'update') {
                    $sendedAbsences = isset($_POST['absences']) ? $_POST['absences'] : [];
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
                $absences = Absence::make()->ofCourseAt($course, $date);

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

        return false;

    }

}
