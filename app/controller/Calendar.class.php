<?php

Class CalendarController extends Controller {

    const DEPENDENCIES = ['Auth'];

    const PERMISSION_REQUIRED = User::STUDENT;

    public function index() {
        // Get current user
        $user = $this->auth->current();
        
        // Pass data to view
        $this->set('month', [1, 2, 3]);
        $this->set('user', $user);

        // Pass courses
        $group = $user->getGroup();
        $courses = $group->getCourses();
        $this->set('courses', $courses);

        // Pass calendar
        $absences = Factory::create(new Absence)->ofStudent($user);
        $days = Date::getDaysInYear();
        $calendar = [];

        foreach ($days as $day) {
            $add = [
                'date' => $day->toString(),
                'absences' => [],
                'courses' => []
            ];
            foreach ($absences as $absence) {
                if ($absence->isAt($day)) {
                    $add['absences'][] = $absence->get('course');
                }
            }
            foreach ($courses as $course) {
                if ($day->getTime() >= $course->get('startdate') and $day->getTime() <= $course->get('enddate')) {
                    if ($day->isDayOfWeek($course->get('dayofweek'))) {
                        $add['courses'][] = $course->getId();
                    }
                }
            }
            $calendar[] = $add;
        }

        $this->set('calendar', $calendar);
        
    }

}
