<!-- Inclus la navbar -->
<?php $this->view('module/includes/navbar') ?>

<div class="container">
    <h3 class="title">Mes absences</h3>
    
    <div class="calendar dashbox">
        <?php foreach ($data['calendar'] as $month):
                $monthSingle = str_replace('-', '', substr($month['days'][0]['date'], 4, 2));
        ?>
            <div class="month <?php if ($monthSingle == date('m')): ?>active<?php endif; ?>">
                <h3 class="month-name"><?= $month['name'] ?></h3>
                <?php foreach ($month['days'] as $date): 
                        $daySingle = substr($date['date'], 0, 2);
                        $currentDay = (date('d') > 9) ? date('d') : "0". date('d');
                ?>
                    <!-- 
                        onclick = courseList( [liste des cours], [liste des absences], [date du jour] )

                        Par exemple:
                        courseList([4, 6], [ [id, cours] ], '24-09-2015')
                        courseList([4, 6], [ [2, 4] ], '24-09-2015')

                        = On affiche le cours 4 et 6, et il y a une absence #2 pour le cours 4

                    -->
                    <div class="item <?php if (!empty($date['absences'])): ?>missing<?php endif; ?> <?php if($daySingle == $currentDay): ?>active<?php endif; ?>">
                        <a href="#" 
                            onclick="return App.calendar.courseList(<?= json_encode($date['courses']) ?>, <?= json_encode($date['absences']) ?>, '<?= $date['date'] ?>')"
                        ><?= $daySingle ?></a>
                    </div>
                <?php endforeach; ?>

                <div class="clear"></div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="course-list dashbox nopadding">
        <div class="item parent">Cours</div>
        <?php foreach ($data['courses'] as $course): ?>
            <a class="item view-course" href="#" data-src="/absences/view/" data-id="<?= $course->getId() ?>">
                <?= $course->get('name') ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="clear"></div>
</div>
