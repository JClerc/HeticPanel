
<?php $this->view('module/includes/navbar') ?>

Calendrier:
<?php foreach ($data['month'] as $day): ?>
    <a href="#" onclick="courseList([<?= implode(',', $day['courses']) ?>])">[<?= $day['date'] ?>]</a>
<?php endforeach; ?>

<br>
<br>

Cours:
<div id="courses">
    <?php foreach ($data['courses'] as $course): ?>
        <a href="#" onclick="selectCourse(<?= $course->getId() ?>)" data-id="<?= $course->getId() ?>">[<?= $course->get('name') ?>]</a>
    <?php endforeach; ?>
</div>

<script>
    function courseList(courses) {
        var container = document.querySelector('#courses');
        var items = container.querySelector('a');
        for (var i = 0; i < items.length; i++) {
            if (courses.indexOf(~~items[i].dataset.id) === -1) {
                items[i].style.display = 'none';
            } else {
                items[i].style.display = '';
            }
        }
    }
</script>
