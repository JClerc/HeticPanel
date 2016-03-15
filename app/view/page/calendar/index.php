
<?php $this->view('module/includes/navbar') ?>

Calendrier:

<?php foreach ($data['calendar'] as $date): ?>
    <?php if (!empty($date['absences'])): ?>
        <b><a href="#" onclick="return courseList([<?= implode(',', $date['courses']) ?>], [<?= implode(',', $date['absences']) ?>])">[<?= $date['date'] ?>]</a></b>
    <?php else: ?>
        <a href="#" onclick="return courseList([<?= implode(',', $date['courses']) ?>])">[<?= $date['date'] ?>]</a>
    <?php endif; ?>
<?php endforeach; ?>

<br>
<br>

Cours:
<div id="courses">
    <?php foreach ($data['courses'] as $course): ?>
        <a href="#" onclick="return selectCourse(<?= $course->getId() ?>)" data-id="<?= $course->getId() ?>">[<?= $course->get('name') ?>]</a>
    <?php endforeach; ?>
</div>

<script>
    function courseList(courses, absences) {
        var container = $('#courses');
        var items = $('a', container);
        items.each(function () {
            $(this).toggle(courses.indexOf(~~$(this).data('id')) > -1);
            if (absences && absences.indexOf(~~$(this).data('id')) > -1) {
                $(this).css('color', 'red');
            } else {
                $(this).css('color', '');                
            }
        });
        console.log(absences);
        return false;
    }
    function selectCourse(id) {
        alert(id);
        return false;
    }
</script>
