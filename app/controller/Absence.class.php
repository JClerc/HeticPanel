<?php

class AbsenceController extends Controller {

    const DEPENDENCIES = ['Router'];
    
    public function review($request) {

        if (count($request) === 1) {

            $absence = Factory::create(new Absence);
            $absence->fromId($request[0]);

            if ($absence->exists()) {

                $this->set('absence', $absence);
                $this->set('date',   $absence->getDate());
                $this->set('course', $absence->getCourse());

                return;

            }

        }

        $this->router->go('error');

    }

}
