<?php

class AbsenceController extends Controller {

    const DEPENDENCIES = ['Router', 'Auth', 'Flash'];
    
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

                    $state = intval($absence->get('state'));
                    $currentReason = '';
                    $form = false;
                    $information = 'Une erreur est survenue..';

                    if ($state === Absence::STATE_ABSENT) {
                        $form = true;
                        $information = 'Envoyez un justificatif de votre absence.';
                    } else if ($state === Absence::STATE_LATE) {
                        $form = true;
                        $information = 'Envoyez un justificatif de votre retard.';
                    } else if ($state === Absence::STATE_PENDING) {
                        $form = true;
                        $information = 'Un justificatif a déjà été envoyé. Vous pouvez le modifier en renvoyant le formulaire.';
                        $currentReason = $absence->get('reason');
                    } else if ($state === Absence::STATE_DENIED) {
                        $form = false;
                        $information = 'Votre justificatif a été refusé.';
                    } else if ($state === Absence::STATE_ACCEPTED) {
                        $form = false;
                        $information = 'Votre justificatif a été accepté.';
                    }

                    $this->set('currentReason', e($currentReason));
                    $this->set('information', $information);
                    $this->set('form', $form);

                    if (POST) {

                        if (empty($_POST['reason'])) {
                            $this->flash->set(false, 'Vous n\'avez pas envoyé de raison.');
                            return;
                        }

                        $saveTo = APP . 'upload/' . $absence->getId();

                        if (empty($_FILES['proof']) or $_FILES['proof']['size'] === 0) {

                            if (is_file($saveTo . '.jpg')) {
                                unlink($saveTo . '.jpg');
                            }

                        } else {

                            $img = new Image;
                            try {
                                $img->upload($_FILES['proof'], $saveTo);
                            } catch (Exception $e) {
                                $this->flash->set(false, $e->getMessage());
                                return;
                            }

                        }

                        $absence->addReason($_POST['reason']);
                        
                        $this->flash->set(true, 'Justification envoyée !');

                    }

                    return;

                }

            }

        }

        $this->router->go('error');

    }

}
