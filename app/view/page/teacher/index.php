
<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>

<h3 class="title">
    Bonjour 
    <span><?= substr($data['user']->get('firstname'), 0, 1); ?>. <?= strtoupper($data['user']->get('lastname')); ?></span>
</h3>

<section class="container">
    <a href="/teacher/roll" class="dashbox sided">
        <h3 class="box-title">Faire l'appel</h3>
    </a>

    <a href="/teacher/course" class="dashbox sided">
        <h3 class="box-title">Liste des présents</h3>
    </a>
</section>
