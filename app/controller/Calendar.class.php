<?php

Class CalendarController extends Controller {

    const DEPENDENCIES = ['Auth'];

    const PERMISSION_REQUIRED = User::STUDENT;

    public function index() {
        // Get current user
        $user = $this->auth->current();
        
        // Pass data to view
        $this->set('user', $user);

        // Pass courses
        $group = $user->getGroup();
        $courses = $group->getCourses();
        $this->set('courses', $courses);

        // Get absences list
        $absences = Factory::create(new Absence)->ofStudent($user);

        // Get days in year
        $months = Calendar::getMonthInYear();
        $calendar = [];

        foreach ($months as $key => $month) {
            
            $calendar[$key] = [
                'days' => [],
                'name' => Calendar::getMonthName($key)
            ];

            foreach ($month as $day) {
                
                $add = [
                    'date' => $day->toString(),
                    'absences' => [],
                    'courses' => [],
                    'week' => $day->getDayOfWeek(),
                ];

                foreach ($absences as $absence) {
                    if ($absence->isAt($day)) {
                        $add['absences'][] = [$absence->getId(), intval($absence->get('course'))];
                    }
                }

                foreach ($courses as $course) {
                    if ($day->getTime() >= $course->get('startdate') and $day->getTime() <= $course->get('enddate')) {
                        if ($day->isDayOfWeek($course->get('dayofweek'))) {
                            $add['courses'][] = $course->getId();
                        }
                    }
                }

                $calendar[$key]['days'][] = $add;
            }

        }

        $this->set('calendar', $calendar);
        
    }

}
