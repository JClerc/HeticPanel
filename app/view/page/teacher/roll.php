
<!-- TODO: Javascript pour passer au suivant -->

<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>

<!-- Formulaire a envoyer une fois l'appel terminé -->
<!-- -> $(form).submit() -->
<form method="post">

    <!-- 
        // data-index = index de l'éleve dans la liste
        // A utiliser pour passer au suivant
        // Le premier a la classe "current", et le deuxieme a la classe "next"
        <div class="student current" data-index="0">
            <div class="name">
                // Le nom de l'élève
                Bastien BERGAGLIA
            </div>
            <div class="hidden">
                // Case a cocher ou pas en Javascript
                // "value" sera préremplis en PHP
                <input type="checkbox" value="4" name="absences[]">
            </div>
        </div>
     -->

    <div class="students">
        <?php foreach ($data['students'] as $student): ?>
            <div class="student <?= $student['class'] ?>" data-index="<?= $student['index'] ?>">
                <div class="name">
                    <?= $student['user']->get('firstname') ?> <?= $student['user']->get('lastname') ?> 
                </div>
                <div class="hidden">
                    <input type="checkbox" value="<?= $student['user']->getId() ?>" name="absences[]">
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</form>
