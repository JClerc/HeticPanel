<?php $this->view('module/includes/navbar') ?>

<section class="container">
    <?php $data['flash']->display() ?>

    <h3 class="title">Liste des absents</h3>
    
    <div class="course-list">
        <div class="dashbox select-box select-promotion nopadding">
            <div class="label">
                <?php if ($data['selected']['promotion']): ?>
                    <div class="item missing">P<?= $data['selected']['promotion']->getYear() ?></div>
                <?php else: ?>
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
                <?php endif; ?>
            </div>
        </div>
        <br>

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
    
    <div class="calendar dashbox">
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

            <h3 class="month-name"><?= $data['selected']['date']->toString() ?></h3>
            <div class="clear"></div>
        <?php endif; ?>

        <?php if (!empty($data['students'])): ?>
            <form method="post" class="students-form tight">
                <input type="hidden" name="promotion" value="<?= $data['selected']['promotion']->getId() ?>">
                <input type="hidden" name="group" value="<?= $data['selected']['group']->getId() ?>">
                <input type="hidden" name="course" value="<?= $data['selected']['course']->getId() ?>">
                <input type="hidden" name="date" value="<?= $data['selected']['date']->toString() ?>">
                <input type="hidden" name="method" value="update">

                <!--
                    // Exemple:

                    <div class="student">
                        <label for="student-24" class="name">
                            Ronan Fourreau 
                        </label>
                        <div class="checkbox">
                            <input id="student-24" type="checkbox" value="76" name="absences[]" >
                        </div>
                    </div>
                 -->
                
                <?php 
                $count = ceil(count($data['students']) / 3);
                for ($offset = 1; $offset <= 3; $offset++): 
                ?>
                <div class="students">
                    <?php 
                        $last = ($offset == 3) ? $offset-1 : 1;
                        for ($i = $count * ($offset-1); $i <= ($count * $offset) - $last; $i++): 
                            $student = $data['students'][$i];
                    ?>
                        <div class="student">
                            <label for="student-<?= $student['index'] ?>" class="name">
                                <?= $student['user']->get('firstname') ?> <?= $student['user']->get('lastname') ?> 
                            </label>
                            <div class="hidden">
                                <input id="student-<?= $student['index'] ?>" type="checkbox" value="<?= $student['user']->getId() ?>" name="absences[]" <?= $student['absent'] ? 'checked' : '' ?>>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
                <?php endfor; ?>
            </form>
        <?php else: ?>
            Aucun étudiant
        <?php endif; ?>
    </div>

    <?php if (!empty($data['students'])): ?>
        <div class="students-submit-cont">
            <button class="students-submit" onclick="$('.students-form').submit()">Envoyer</button>
        </div>
        <br>
    <?php endif; ?>
</section>
