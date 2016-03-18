
<?php $this->view('module/includes/navbar') ?>

<div class="container">
    <h3 class="title">Mes absences</h3>

    <?php $data['flash']->display() ?>

    <form method="post">
        <input type="password" name="password" placeholder="Mot de passe">
        <input type="password" name="confirm" placeholder="Confirmez">
        <button type="submit">Valider</button>
    </form>

</div>
