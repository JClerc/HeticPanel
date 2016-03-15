
<?php $this->view('module/includes/navbar') ?>

<div class="container">
    <h3 class="title">Mes absences</h3>
    
    <div class="calendar dashbox">
        <?php foreach ($data['calendar'] as $month): ?>
            <div class="month <?= $month['current'] ? 'active' : '' ?>">
                <h3 class="month-name"><?= $month['name'] ?></h3>
                <?php for ($i = 1; $i < count(Calendar::DAY_LOCALE_FR); $i++): ?>                    
                    <div class="item item-label"><?= Calendar::DAY_LOCALE_FR[$i] ?></div>
                <?php endfor; ?>
                <?php for ($i=1; $i < $month['offset']; $i++): ?>
                    <div class="item item-offset"></div>
                <?php endfor; ?>
                <?php foreach ($month['days'] as $date): ?>
                    <a class="item item-day <?= !empty($date['absences']) ? 'missing' : '' ?> <?= $date['current'] ? 'active' : '' ?>"  
                       onclick="return App.calendar.courseList(<?= json_encode($date['courses']) ?>, <?= json_encode($date['absences']) ?>, '<?= $date['date'] ?>')"
                       href="#">
                       <?= $date['day'] ?>
                    </a>
                <?php endforeach; ?>
                <div class="clear"></div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="course-list dashbox nopadding">
        <div class="item parent">Cours</div>
        <?php foreach ($data['courses'] as $course): ?>
            <a class="item view-course" href="#" data-src="/absence/review/" data-id="<?= $course->getId() ?>" style="display: none;">
                <?= $course->get('name') ?>
            </a>
        <?php endforeach; ?>
        <div class="item view-course item-choose-date">
            Séléctionnez une date.
        </div>
        <div class="item view-course item-no-courses" style="display: none;">
            Aucun cours disponible.
        </div>
    </div>

    <div class="clear"></div>
</div>
