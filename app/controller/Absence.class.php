<?php

class AbsenceController extends Controller {
    
    public function review($request) {

        $absence = Factory::create(new Absence);
        $absence->fromId($request[0]);

        $this->set('absence', $absence);

    }

}
