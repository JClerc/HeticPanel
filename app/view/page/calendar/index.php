
<?php $this->view('module/includes/navbar') ?>

Calendrier:
<?php foreach ($data['month'] as $day): ?>
    [<?= $day ?>]
<?php endforeach; ?>
