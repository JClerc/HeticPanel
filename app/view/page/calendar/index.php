
<?php $this->view('module/includes/navbar') ?>

<div class="container">
    <h3 class="title">Mes absences</h3>
    
    <div class="calendar dashbox">
        <?php foreach ($data['calendar'] as $month): ?>
            <div class="month <?= $month['current'] ? 'active' : '' ?>">
                <h3 class="month-name"><?= $month['name'] ?></h3>
                <?php foreach ($month['days'] as $date): ?>
                    <div class="item <?= !empty($date['absences']) ? 'missing' : '' ?> <?= $date['current'] ? 'active' : '' ?>">
                        <a href="#" 
                            onclick="return App.calendar.courseList(<?= json_encode($date['courses']) ?>, <?= json_encode($date['absences']) ?>, '<?= $date['date'] ?>')"
                        ><?= $date['day'] ?></a>
                    </div>
                <?php endforeach; ?>

                <div class="clear"></div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="course-list dashbox nopadding">
        <div class="item parent">Cours</div>
        <?php foreach ($data['courses'] as $course): ?>
            <a class="item view-course" href="#" data-src="/absence/review/" data-id="<?= $course->getId() ?>">
                <?= $course->get('name') ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="clear"></div>
</div>
