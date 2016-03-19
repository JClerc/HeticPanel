
<!-- ================================================= -->
<!-- Aucun JS a faire pour cette page, juste de l'inté -->
<!-- ================================================= -->

<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>
<?php
    $count = ceil(count($data['students']) / 3);
?>

<h3 class="title">Liste des absents</h3>

<section class="container">
    <div class="dashbox">
        <center>
        <h3 class="course-title">Cours du <?= date('d/m/Y') ?></h3>
        </center>
        
        <div class="students-form">
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

            <?php for ($offset = 0; $offset < 3; $offset++): ?>
                <div class="students">
                    <?php for ($i = $count * $offset; $i <= ($count * ($offset + 1)) - $offset; $i++): 
                        $student = $data['students'][$i];
                    ?>
                        <div class="student <?= $student['class'] ?>" data-index="<?= $student['index'] ?>">
                            <label for="<?= $student['user']->getId() ?>" class="name">
                                <?= $student['user']->get('firstname') ?> <?= $student['user']->get('lastname') ?> 
                            </label>
                            <div class="hidden">
                                <input id="<?= $student['index'] ?>" type="checkbox" value="<?= $student['user']->getId() ?>" name="absences[]" <?= $student['absent'] ? 'checked' : '' ?> disabled>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
