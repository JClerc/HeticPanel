
<?php $this->view('module/includes/navbar') ?>

<section class="container">
    <h3 class="title">Absences justifiées</h3>

    <?php $data['flash']->display() ?>

    <!-- Liste des absences sur la gauche -->
    <?php if (empty($data['absences'])): ?>
        <div class="absence-view dashbox">
            <h3>Aucun justificatif en attente.</h3>
        </div>
    <?php else: ?>
        <div class="absence-list course-list dashbox nopadding">
            <?php foreach ($data['absences'] as $absence): ?>
                <div class="item">
                    <a href="#" class="absence-entry" data-id="<?= $absence->getId() ?>" data-img="<?= $absence->getImageSrc() ?>" onclick="return App.panel.justify(this);">
                        <h3 class="name">
                            <?= $absence->getStudent()->get('firstname') ?> <?= $absence->getStudent()->get('lastname') ?>
                        </h3>
                        <p>
                            <?= $absence->getDate()->getDay() ?> <?= $absence->getDate()->getMonthName() ?> <?= $absence->getDate()->getYear() ?> – <?= $absence->getCourse()->get('name') ?>                
                        </p>
                        <div class="hidden reason" style="display: none;">
                            <?= nl2br(e($absence->get('reason'))) ?>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>

            <div class="clear"></div>
        </div>

        <!-- Vue d'une absence sur la droite -->
        <div class="absence-view calendar dashbox">
            <div class="no-select">
                <h3>Sélectionnez une absence.</h3>
            </div>

            <div class="details" style="display: none;">
                <h2><span class="name"></span></h2>

                <h4>Raison</h4>
                <div class="reason"></div>

                <h4>Image</h4>
                <div class="img"></div>

                <form method="post" class="form-sided">
                    <input type="hidden" value="deny" name="action">
                    <input type="hidden" name="id" value="" class="entry-id">
                    <button class="absence-submit">Refuser</button>
                </form>

                <form method="post" class="form-sided">
                    <input type="hidden" value="accept" name="action">
                    <input type="hidden" name="id" value="" class="entry-id">
                    <button class="absence-submit">Accepter</button>
                </form>
            </div>
        </div>

    <?php endif; ?>
</section>
