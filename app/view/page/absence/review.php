
<?php $this->view('module/includes/navbar') ?>

<div class="container">
    <h3 class="title">Absence du <?= $data['date']->getDay() ?> <?= $data['date']->getMonthName() ?></h3>

    <?php $data['flash']->display() ?>
    
    <div class="course-list dashbox nopadding">
        <div class="item parent">Cours manqué</div>
        <a class="item view-course missing" href="#">
            <?= $data['course']->get('name') ?>
        </a>
    </div>
    
    <form method="post" class="absence-form" enctype="multipart/form-data">
        <div class="calendar">
            <div class="dashbox">
                <p class="absence-infos">
                    <?= $data['information'] ?>
                </p>

                <?php if ($data['form']): ?>
                    <h3>Motif de l'absence</h3>
                    <textarea name="reason" id="" class="absence-reason" placeholder="Raison"><?= $data['currentReason'] ?></textarea>
                <?php endif; ?>

                <div class="clear"></div>
            </div>
            
            <?php if ($data['form']): ?>
                <div class="dashbox dashbox-file">
                    <input type="file" name="proof">
                </div>

                <center>
                    <button class="logout absence-submit" type="submit">Envoyer la justification</button>
                </center>
            <?php endif; ?>
        </div>
    </form>

</div>
