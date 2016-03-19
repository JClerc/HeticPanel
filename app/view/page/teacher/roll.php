
<!-- TODO: Javascript pour passer au suivant -->

<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>

<h3 class="title">Faire l'appel</h3>

<section class="container">
    <div class="dashbox dashbox-students">
        <h3 class="course-title">Cours du <?= date('d/m/Y') ?></h3>

        <!-- Formulaire a envoyer une fois l'appel terminé -->
        <!-- -> $(form).submit() -->
        <form method="post" class="students-form">
            <div class="roll-students" data-count="<?= count($data['students']) ?>">
                <?php foreach ($data['students'] as $index => $student): ?>
                    <div class="roll-student <?= $student['class'] ?>" data-index="<?= $index ?>">
                        <label for="student-<?= $student['user']->getId() ?>" class="name">
                            <?= $student['user']->get('firstname') ?> <?= $student['user']->get('lastname') ?> 
                        </label>
                        <div class="hidden">
                            <input type="checkbox" id="student-<?= $student['user']->getId() ?>" value="<?= $student['user']->getId() ?>" name="absences[]">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>
    
        <div class="tuto">
            <div class="item">
                <div class="icon"></div>
                <div class="desc">
                    <h3>ESPACE</h3>
                    <p>Elèvre présent</p>
                </div>
            </div>

            <div class="item">
                <div class="icon"></div>
                <div class="desc">
                    <h3>ENTRER</h3>
                    <p>Elèvre absent</p>
                </div>
            </div>

            <div class="clear"></div>
        </div>
</section>

<script>
// CHARGE ROLL.JS APRES JQUERY
(function () {
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.src = '/assets/js/app/roll.js';
    document.body.appendChild(s);
})();
</script>
