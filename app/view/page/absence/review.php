
<?php $this->view('module/includes/navbar') ?>

<div class="container">
    <h3 class="title">Mes absences</h3>

    <?php $this->flash->display() ?>

    Tu as été absent le <?= $data['date']->toString() ?> en cours de <?= $data['course']->get('name') ?>.


    <?= $data['information'] ?>


    <?php if ($data['form']): ?>

        <form method="post" enctype="multipart/form-data">
            <textarea name="reason" id="" cols="30" rows="10" placeholder="Raison"><?= $data['currentReason'] ?></textarea>
            <input type="file" name="proof">
            <button type="submit">Valider</button>
        </form>

    <?php endif; ?>

</div>
