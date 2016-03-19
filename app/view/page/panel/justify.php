
<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>

<!-- Liste des absences sur la gauche -->
<?php if (empty($data['absences'])): ?>
    <div class="no-absence">
        Aucun justificatif en attente.
    </div>
<?php else: ?>
    <div class="absence-list">
        <?php foreach ($data['absences'] as $absence): ?>

            <div>
                <a href="#" class="absence-entry" data-id="<?= $absence->getId() ?>" data-img="<?= $absence->getImageSrc() ?>" onclick="return App.panel.justify(this);">
                    <h3 class="name">
                        <?= $absence->getStudent()->get('firstname') ?> <?= $absence->getStudent()->get('lastname') ?>
                    </h3>
                    <p>
                        Absent le <?= $absence->getDate()->getDay() ?> <?= $absence->getDate()->getMonthName() ?> <?= $absence->getDate()->getYear() ?>
                        en cours de <?= $absence->getCourse()->get('name') ?>                
                    </p>
                    <div class="hidden reason" style="display: none;">
                        <?= e($absence->get('reason')) ?>
                    </div>
                </a>
            </div>

        </div>
    <?php endforeach; ?>

    <!-- Vue d'une absence sur la droite -->
    <div class="absence-view">
        <div class="no-select">
            Sélectionnez une absence.
        </div>

        <div class="details" style="display: none;">
            
            <h4>Eleve: <span class="name"></span></h4>

            <h4>Raison:</h4>
            <div class="reason"></div>

            <h4>Image</h4>
            <div class="img"></div>

            <form method="post">
                <input type="hidden" value="deny" name="action">
                <input type="hidden" name="id" value="" class="entry-id">
                <button type="submit">Refuser</button>
            </form>

            <form method="post">
                <input type="hidden" value="accept" name="action">
                <input type="hidden" name="id" value="" class="entry-id">
                <button type="submit">Accepter</button>
            </form>

        </div>

    </div>

<?php endif; ?>
