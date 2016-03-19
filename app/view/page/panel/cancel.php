
<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>


<!-- Choix de la promotion -->

<div class="select-box select-promotion">
    
    <div class="label">
        <?php if ($data['selected']['promotion']): ?>
            P<?= $data['selected']['promotion']->getYear() ?>
        <?php else: ?>
            Promotion
        <?php endif; ?>
    </div>

    <div class="choices">
        <form method="post">

            <?php foreach ($data['promotions'] as $promotion): ?>
            <button type="submit" name="promotion" value="<?= $promotion->getId(); ?>">P<?= $promotion->getYear(); ?></button>
            <?php endforeach; ?>

        </form>        
    </div>

</div>



<hr> <!-- Choix du groupe -->

<?php if ($data['selected']['promotion']): ?>

<div class="select-box select-promotion">
    
    <div class="label">
        <?php if ($data['selected']['group']): ?>
            G<?= $data['selected']['group']->getIndex() ?>
        <?php else: ?>
            Groupe
        <?php endif; ?>
    </div>

    <div class="choices">
        <form method="post">
            <input type="hidden" name="promotion" value="<?= $data['selected']['promotion']->getId() ?>">

            <?php foreach ($data['groups'] as $group): ?>
            <button type="submit" name="group" value="<?= $group->getId(); ?>">G<?= $group->getIndex(); ?></button>
            <?php endforeach; ?>

        </form>
    </div>

</div>

<?php endif; ?>



<hr> <!-- Choix du cours -->

<?php if ($data['selected']['group']): ?>

<div class="select-box select-promotion">
    
    <div class="label">
        <?php if ($data['selected']['course']): ?>
            <?= $data['selected']['course']->get('name') ?>
        <?php else: ?>
            Cours
        <?php endif; ?>
    </div>

    <div class="choices">
        <form method="post">
            <input type="hidden" name="promotion" value="<?= $data['selected']['promotion']->getId() ?>">
            <input type="hidden" name="group" value="<?= $data['selected']['group']->getId() ?>">

            <?php foreach ($data['courses'] as $course): ?>
            <button type="submit" name="course" value="<?= $course->getId(); ?>"><?= $course->get('name'); ?></button>
            <?php endforeach; ?>
        </form>
    </div>

</div>

<?php endif; ?>



<hr> <!-- Choix de la date -->

<?php if ($data['selected']['date']): ?>

<h4><?= $data['selected']['date']->toString() ?></h4>

    <?php if ($data['relative-date']['prev']): ?>
    <form method="post">
        <input type="hidden" name="promotion" value="<?= $data['selected']['promotion']->getId() ?>">
        <input type="hidden" name="group" value="<?= $data['selected']['group']->getId() ?>">
        <input type="hidden" name="course" value="<?= $data['selected']['course']->getId() ?>">
        <input type="hidden" name="date" value="<?= $data['relative-date']['prev']->toString() ?>">
        <button type="submit" name="method" value="view-prev">Cours précédent</button>
    </form>
    <?php endif; ?>

    <?php if ($data['relative-date']['next']): ?>
    <form method="post">
        <input type="hidden" name="promotion" value="<?= $data['selected']['promotion']->getId() ?>">
        <input type="hidden" name="group" value="<?= $data['selected']['group']->getId() ?>">
        <input type="hidden" name="course" value="<?= $data['selected']['course']->getId() ?>">
        <input type="hidden" name="date" value="<?= $data['relative-date']['next']->toString() ?>">
        <button type="submit" name="method" value="view-next">Cours suivant</button>
    </form>
    <?php endif; ?>

<?php endif; ?>



<hr> <!-- Annuler le cours -->

<?php if (isset($data['cancel'])): ?>

    <form method="post">

        <input type="hidden" name="promotion" value="<?= $data['selected']['promotion']->getId() ?>">
        <input type="hidden" name="group" value="<?= $data['selected']['group']->getId() ?>">
        <input type="hidden" name="course" value="<?= $data['selected']['course']->getId() ?>">
        <input type="hidden" name="date" value="<?= $data['selected']['date']->toString() ?>">

        <?php if ($data['cancel']): ?>
            
            <p>Cours annulé !</p>

        <?php else: ?>

            <div class="send">
                <p>Toutes les absences seront annulées.</p>
                <button type="submit" name="cancel" value="true">Annuler le cours</button>
            </div>

        <?php endif; ?>
        
    </form>

<?php endif; ?>
