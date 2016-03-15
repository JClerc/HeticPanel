<!-- Inclus la navbar -->
<?php $this->view('module/includes/navbar') ?>

<!-- Vue du calendrier -->
Calendrier:

<!-- Pour chaque mois -->
<?php foreach ($data['calendar'] as $month): ?>

    <!-- On affiche le nom du mois -->
    <h3><?= $month['name'] ?></h3>

    <!-- Et pour chaque jour -->
    <?php foreach ($month['days'] as $date): ?>

        <!-- Si il a une absence -->
        <?php if (!empty($date['absences'])): ?>
            <b>ABSENCE:</b>
        <?php endif; ?>

        <!-- 
            onclick = courseList( [liste des cours], [liste des absences], [date du jour] )

            Par exemple:
            courseList([4, 6], [ [id, cours] ], '24-09-2015')
            courseList([4, 6], [ [2, 4] ], '24-09-2015')

            = On affiche le cours 4 et 6, et il y a une absence #2 pour le cours 4

        -->
        <a href="#" onclick="return App.calendar.courseList(<?= json_encode($date['courses']) ?>, <?= json_encode($date['absences']) ?>, '<?= $date['date'] ?>')">
    
            <!-- On affiche la date -->
            [<?= $date['date'] ?>]

        </a>

    <?php endforeach; ?>

<?php endforeach; ?>


<br>
<br>

<!-- Liste des cours en fonction de la date -->
Cours:
<div class="course-list">

    <!-- On affiche tout les cours par défaut -->
    <?php foreach ($data['courses'] as $course): ?>

        <!-- 
            Il faut rediriger vers la page:
            /calendar/view/<id du cours>/<date du jour>/
        -->
        <a class="view-course" href="#" data-src="/absence/review/" data-id="<?= $course->getId() ?>">

            <!-- On affiche le nom du cours -->
            [<?= $course->get('name') ?>]

        </a>

    <?php endforeach; ?>

</div>
