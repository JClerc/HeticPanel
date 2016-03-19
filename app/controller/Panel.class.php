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
    
    public function course() {}
    
    public function cancel() {}

    public function admin() {}

}
