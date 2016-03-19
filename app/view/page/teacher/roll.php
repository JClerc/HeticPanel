
<!-- TODO: Javascript pour passer au suivant -->

<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>

<?php
    $count = ceil(count($data['students']) / 3);
?>

<h3 class="title">Faire l'appel</h3>

<section class="container">
    <div class="dashbox dashbox-students">
        <h3 class="course-title">Cours du <?= date('d/m/Y') ?></h3>
        <h4 class="course-subtitle">Cochez uniquement les absences</h4>

        <!-- Formulaire a envoyer une fois l'appel terminé -->
        <!-- -> $(form).submit() -->
        <form method="post" class="students-form">
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
                                <input type="checkbox" id="<?= $student['user']->getId() ?>" value="<?= $student['user']->getId() ?>" name="absences[]">
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
        </form>
    </div>

    <div class="students-submit-cont">
        <button class="students-submit" onclick="$('.students-form').submit();">Envoyer</button>
    </div>

    <br><br>
</section>
