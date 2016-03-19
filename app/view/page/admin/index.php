
<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>

<h3 class="title">
    Bonjour 
    <span><?= substr($data['user']->get('firstname'), 0, 1); ?>. <?= strtoupper($data['user']->get('lastname')); ?></span>
</h3>

<section class="container">
    <a href="/admin/promotion" class="dashbox sided">
        <h3 class="box-title">Gérer les promotions</h3>
    </a>

    <a href="/admin/group" class="dashbox sided">
        <h3 class="box-title">Gérer les groupes</h3>
    </a>

    <div class="clear"></div>
</section>

<section class="container" style="margin-top: 20px">
    <a href="/admin/course" class="dashbox sided">
        <h3 class="box-title">Gérer les cours</h3>
    </a>

    <a href="/admin/user" class="dashbox sided">
        <h3 class="box-title">Gérer les utilisateurs</h3>
    </a>
</section>
