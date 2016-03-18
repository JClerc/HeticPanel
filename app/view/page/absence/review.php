
<?php $this->view('module/includes/navbar') ?>

<div class="container">
    <h3 class="title">Absence du <?= $data['date']->toString() ?></h3>

    <?php $this->flash->display() ?>
    
    <div class="course-list dashbox nopadding">
        <div class="item parent">Cours manqué</div>
        <a class="item view-course missing" href="#">
            <?= $data['course']->get('name') ?>
        </a>
    </div>

    <div class="calendar dashbox">
        <p>
            <?= $data['information'] ?>
        </p>

        <?php if ($data['form']): ?>
            <form method="post" enctype="multipart/form-data">
                <textarea name="reason" id="" cols="30" rows="10" placeholder="Raison"><?= $data['currentReason'] ?></textarea>
                <input type="file" name="proof">
                <button type="submit">Valider</button>
            </form>
        <?php endif; ?>
    </div>

</div>
