
<?php $this->view('module/includes/navbar') ?>

Calendrier:

<?php foreach ($data['calendar'] as $date): ?>
    <?php if (!empty($date['absences'])): ?>
        <b>
    <?php endif; ?>
    <a href="#" onclick="return courseList([<?= implode(',', $date['courses']) ?>], [<?= implode(',', $date['absences']) ?>], '<?= $date['date'] ?>')">[<?= $date['date'] ?>]</a>
    <?php if (!empty($date['absences'])): ?>
        </b>
    <?php endif; ?>
<?php endforeach; ?>

<br>
<br>

Cours:
<div id="courses">
    <?php foreach ($data['courses'] as $course): ?>
        <a href="#" data-src="/calendar/view/<?= $course->getId() ?>/" data-id="<?= $course->getId() ?>">[<?= $course->get('name') ?>]</a>
    <?php endforeach; ?>
</div>

<script>
    function courseList(courses, absences, date) {
        var container = $('#courses');
        var items = $('a', container);
        items.each(function () {
            $(this).attr('href', $(this).data('src') + date + '/');
            $(this).toggle(courses.indexOf(~~$(this).data('id')) > -1);
            if (absences.indexOf(~~$(this).data('id')) > -1) {
                $(this).css('color', 'red');
            } else {
                $(this).css('color', '');                
            }
        });
        return false;
    }
</script>
