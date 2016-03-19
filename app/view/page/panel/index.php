
<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>

<h3 class="title">
    Bonjour 
    <span><?= substr($data['user']->get('firstname'), 0, 1); ?>. <?= strtoupper($data['user']->get('lastname')); ?></span>
</h3>

<section class="container">
    <a href="/panel/justify" class="dashbox sided">
        <h3 class="box-title">Réception des justificatifs</h3>
    </a>

    <a href="/panel/course" class="dashbox sided">
        <h3 class="box-title">Liste des absents</h3>
    </a>

    <div class="clear"></div>
</section>

<section class="container" style="margin-top: 20px">
    <a href="/panel/cancel" class="dashbox sided">
        <h3 class="box-title">Annuler un cours</h3>
    </a>

    <a href="/admin/" class="dashbox sided">
        <h3 class="box-title">Administration</h3>
    </a>
</section>
