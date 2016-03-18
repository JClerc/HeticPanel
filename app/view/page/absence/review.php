
<?php $this->view('module/includes/navbar') ?>

<div class="container">
    <h3 class="title">Absence du <?= $data['date']->getDay() ?> <?= $data['date']->getMonthName() ?></h3>

    <?php $this->flash->display() ?>
    
    <div class="course-list dashbox nopadding">
        <div class="item parent">Cours manqué</div>
        <a class="item view-course missing" href="#">
            <?= $data['course']->get('name') ?>
        </a>
    </div>

    <div class="calendar dashbox">
        <p class="absence-infos">
            <?= $data['information'] ?>
        </p>

        <?php if ($data['form']): ?>
            <h3>Justifier cette absence</h3>
            <form method="post" class="absence-form" enctype="multipart/form-data">
                <textarea name="reason" id="" class="absence-reason" placeholder="Raison"><?= $data['currentReason'] ?></textarea>
                <input type="file" name="proof">
                <button class="logout absence-submit" type="submit">Envoyer la justification</button>
            </form>
        <?php endif; ?>

        <div class="clear"></div>
    </div>

</div>
