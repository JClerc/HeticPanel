
<!-- ================================================= -->
<!-- Aucun JS a faire pour cette page, juste de l'inté -->
<!-- ================================================= -->

<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>

Cochez uniquement les absences

<form method="post">

    <!--
        // Exemple:

        <div class="student">
            <label for="student-24" class="name">
                Ronan Fourreau 
            </label>
            <div class="checkbox">
                <input id="student-24" type="checkbox" value="76" name="absences[]" >
            </div>
        </div>
     -->

    <div class="students">
        <?php foreach ($data['students'] as $student): ?>
            <div class="student">
                <label for="student-<?= $student['index'] ?>" class="name">
                    <?= $student['user']->get('firstname') ?> <?= $student['user']->get('lastname') ?> 
                </label>
                <div class="checkbox">
                    <input id="student-<?= $student['index'] ?>" type="checkbox" value="<?= $student['user']->getId() ?>" name="absences[]" <?= $student['absent'] ? 'checked' : '' ?>>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="send">
        <button type="submit">Valider</button>
    </div>
    
</form>
