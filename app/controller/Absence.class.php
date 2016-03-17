<?php

class AbsenceController extends Controller {

    const DEPENDENCIES = ['Router', 'Auth'];
    
    public function review($request) {

        if (count($request) === 1) {

            $absence = Factory::create(new Absence);
            $absence->fromId($request[0]);

            if ($absence->exists()) {

                $user = $absence->getStudent();

                if ($this->auth->current()->equals($user)) {

                    $this->set('absence', $absence);
                    $this->set('date',   $absence->getDate());
                    $this->set('course', $absence->getCourse());

                    if (POST) {
                        $this->sendReason($_POST['reason'], $_FILES['proof']);
                    }

                    return;

                }

            }

        }

        $this->router->go('error');

    }

    private function sendReason($message, $file) {

    }

}
