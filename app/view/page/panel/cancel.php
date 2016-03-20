
<?php $this->view('module/includes/navbar') ?>

<section class="container">
    <?php $data['flash']->display() ?>

    <h3 class="title">Déclarer un cours annulé</h3>


    <!-- Choix de la promotion -->
    <div class="course-list">
        <div class="dashbox nopadding select-box select-promotion">
            <div class="label">
                <div class="choices">
                    <form method="post">
                        <input type="hidden" name="promotion" value="">
                        <?php foreach ($data['promotions'] as $promotion): ?>
                            <div class="item 
                                <?php if ($data['selected']['promotion'] && $data['selected']['promotion']->getYear() == $promotion->getYear()): ?>missing<?php endif; ?>"
                                onclick="$('[name=promotion]').val('<?= $promotion->getId(); ?>');$(this).parent().submit();"
                            >
                                P<?= $promotion->getYear(); ?>
                            </div>
                        <?php endforeach; ?>
                    </form>        
                </div>
            </div>
        </div>
        <br>

        <!-- Choix du groupe -->
        <?php if ($data['selected']['promotion']): ?>
            <div class="dashbox select-box select-promotion nopadding">
                <div class="choices">
                    <form method="post">
                        <input type="hidden" name="promotion" value="<?= $data['selected']['promotion']->getId() ?>">
                        <input type="hidden" name="group" value="">

                        <?php foreach ($data['groups'] as $group): ?>
                            <div class="item 
                                <?php if ($data['selected']['group'] && $data['selected']['group']->getIndex() == $group->getIndex()): ?>missing<?php endif; ?>"
                                onclick="$('[name=group]').val('<?= $group->getId(); ?>');$(this).parent().submit();"
                            >
                                G<?= $group->getIndex(); ?>
                            </div>
                        <?php endforeach; ?>

                    </form>
                </div>
            </div>
        <?php endif; ?>
        <br>

        <!-- Choix du cours -->
        <?php if ($data['selected']['group']): ?>
            <div class="dashbox select-box select-promotion nopadding">
                <div class="choices">
                    <form method="post">
                        <input type="hidden" name="promotion" value="<?= $data['selected']['promotion']->getId() ?>">
                        <input type="hidden" name="group" value="<?= $data['selected']['group']->getId() ?>">
                        <input type="hidden" name="course" value="">

                        <?php foreach ($data['courses'] as $course): ?>
                            <div class="item 
                                <?php if ($data['selected']['course'] && $data['selected']['course']->get('name') == $course->get('name')): ?>missing<?php endif; ?>"
                                onclick="$('[name=course]').val('<?= $course->getId(); ?>');$(this).parent().submit();"
                            >
                                <?= $course->get('name'); ?>
                            </div>
                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>


    <div class="dashbox calendar">
        <!-- Choix de la date -->
        <?php if ($data['selected']['date']): ?>
            <form method="post">
                <input type="hidden" name="promotion" value="<?= $data['selected']['promotion']->getId() ?>">
                <input type="hidden" name="group" value="<?= $data['selected']['group']->getId() ?>">
                <input type="hidden" name="course" value="<?= $data['selected']['course']->getId() ?>">
                <input type="hidden" name="date" value="<?= ($data['relative-date']['prev']) ? $data['relative-date']['prev']->toString() : '' ?>">
                <span class="calendar-control previous">
                    <?php if ($data['relative-date']['prev']): ?>
                        <button type="submit" name="method" value="view-next">&larr; Cours précédent</button>
                    <?php endif; ?>
                </span>
            </form>

            <form method="post">
                <input type="hidden" name="promotion" value="<?= $data['selected']['promotion']->getId() ?>">
                <input type="hidden" name="group" value="<?= $data['selected']['group']->getId() ?>">
                <input type="hidden" name="course" value="<?= $data['selected']['course']->getId() ?>">
                <input type="hidden" name="date" value="<?= ($data['relative-date']['next']) ? $data['relative-date']['next']->toString() : '' ?>">
                <span class="calendar-control next">
                    <?php if ($data['relative-date']['next']): ?>
                        <button type="submit" name="method" value="view-next">Cours suivant &rarr;</button>
                    <?php endif; ?>
                </span>
            </form>

            <h3 class="month-name"><?= $data['selected']['date']->readable() ?></h3>
            <div class="clear"></div><br>
        <?php endif; ?>

        <!-- Annuler le cours -->
        <?php if (isset($data['cancel'])): ?>
            <form method="post">
                <input type="hidden" name="promotion" value="<?= $data['selected']['promotion']->getId() ?>">
                <input type="hidden" name="group" value="<?= $data['selected']['group']->getId() ?>">
                <input type="hidden" name="course" value="<?= $data['selected']['course']->getId() ?>">
                <input type="hidden" name="date" value="<?= $data['selected']['date']->toString() ?>">

                <?php if ($data['cancel']): ?>
                    <div style="text-align: center;">
                        <p>Cours annulé !</p>
                    </div>
                <?php else: ?>
                    <div class="send" style="text-align: center;">
                        <p>Toutes les absences seront annulées.</p>
                        <button type="submit" name="cancel" class="absence-submit" style="margin-top: 10px;" value="true">Annuler le cours</button>
                    </div>
                <?php endif; ?>
            </form>
        <?php else: ?>
            <h3>Choisissez un cours avec les menu à droite.</h3>
        <?php endif; ?>
    </div>
</section>
