
<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>


<!-- Ajouter -->
<div class="menu menu-add">
    <form method="post">
    
        <!-- Quand on clic la dessus, ca affiche le formulaire -->
        <a href="#" class="menu-title" onclick="$(this).parent().find('.menu-hidden').toggle();">
            Ajouter une promotion
        </a>

        <div class="menu-hidden" style="<?= (isset($data['method-add']) and $data['method-add']) ? '' : 'display: none;' ?>">

            <input type="number" name="year" class="menu-input" placeholder="Année (Ex: Pour P2019 entrez 2019)" value="<?= date('Y') ?>">

            <button type="submit" class="btn-submit" name="method" value="add">Valider</button>
        </div>

    </form>
</div>


<!-- Modifier -->
<div class="menu menu-edit">
    <form method="post">
        
        <div class="menu-title">
            Modifier une promotion
        </div>

        <!-- On choisis celui a modifier -->
        <div class="menu-select">
            <select name="edit">
                <option value="0">Sélectionnez une promotion</option>
                <?php foreach ($data['promotions'] as $promotion): ?>
                    <option value="<?= $promotion->getId() ?>" <?= (isset($data['values']) and $data['values']['promotion']->getId() === $promotion->getId()) ? 'selected' : '' ?>>P<?= $promotion->getYear() ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- 1. On clique sur modifier -->
        <button type="submit" class="btn-submit" name="method" value="retrieve">Modifier</button>

        <?php if (isset($data['values'])): ?>

            <!-- 2. Ca charge les données dans le formulaire -->
            <div class="menu-hidden">

                <input type="number" name="year" class="menu-input" placeholder="Année (Ex: Pour P2019 entrez 2019)" value="<?= $data['values']['promotion']->getYear() ?>">

                <input type="hidden" name="update" value="<?= $data['values']['promotion']->getId() ?>">

                <button type="submit" class="btn-submit" name="method" value="update">Valider</button>
            </div>

        <?php endif; ?>

    </form>
</div>



<div class="menu menu-delete">
    <form method="post">
    
        <div class="menu-title">
            Supprimer une promotion
        </div>

        <!-- On choisis celui a supprimer -->
        <div class="menu-select">
            <select name="delete">
                <option value="0">Sélectionnez une promotion</option>
                <?php foreach ($data['promotions'] as $promotion): ?>
                    <option value="<?= $promotion->getId() ?>">P<?= $promotion->getYear() ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn-submit" name="method" value="delete">Valider</button>

    </form>
</div>

