
<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>

<?php
    $count = ceil(count($data['students']) / 3);
?>

<h3 class="title">Liste des absents</h3>

<section class="container">
    <form method="post">
        <div class="dashbox dashbox-students">
            <h3 class="course-title">Cours du <?= $data['date']->getDay() ?> <?= $data['date']->getMonthName() ?></h3>
            <h4 class="course-subtitle">Cochez uniquement les absences</h4>

            <div class="students-form">

                <?php for ($offset = 1; $offset <= 3; $offset++): ?>
                    <div class="students">
                        <?php 
                        $last = ($offset == 3) ? $offset-1 : 1;
                        for ($i = $count * ($offset-1); $i <= ($count * $offset) - $last; $i++): 
                            if (!isset($data['students'][$i])) continue;
                            $student = $data['students'][$i];
                        ?>
                            <div class="student <?= $student['class'] ?>" data-index="<?= $student['index'] ?>">
                                <label for="<?= $student['user']->getId() ?>" class="name">
                                    <?= $student['user']->get('firstname') ?> <?= $student['user']->get('lastname') ?> 
                                </label>
                                <div class="hidden">
                                    <input type="checkbox" id="<?= $student['user']->getId() ?>" value="<?= $student['user']->getId() ?>" name="absences[]" <?= $student['absent'] ? 'checked' : '' ?>>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>
            </div>
            
        </div>

        <div class="students-submit-cont">
            <button class="students-submit" type="submit">Envoyer</button>
        </div>

    </form>

    <br><br>
</section>
