
<?php $this->view('module/includes/navbar') ?>

<div class="container">
    <h3 class="title">Mon compte</h3>

    <?php $data['flash']->display() ?>
    
    <form method="post">
        <div class="dashbox dashbox-settings">
            <label>Nouveau mot de passe</label><br>
            <input class="settings-input" type="password" name="password" placeholder="Mot de passe">
            
            <br><br>

            <label>Confirmer le mot de passe</label><br>
            <input class="settings-input" type="password" name="confirm" placeholder="Confirmez">
        </div>

        <div class="students-submit-cont">
            <button class="students-submit" type="submit">Modifier le mot de passe</button>
        </div>
    </form>
</div>
