
<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>


<!-- Ajouter -->
<div class="menu menu-add">
    <form method="post">
    
        <!-- Quand on clic la dessus, ca affiche le formulaire -->
        <a href="#" class="menu-title" onclick="$(this).parent().find('.menu-hidden').toggle();">
            Ajouter un groupe
        </a>

        <div class="menu-hidden" style="<?= (isset($data['method-add']) and $data['method-add']) ? '' : 'display: none;' ?>">

            <input type="number" name="index" class="menu-input" placeholder="Index du groupe (Ex: Pour G1 entrez 1)" value="1">

            <select name="promotion" class="menu-select">
                <?php foreach ($data['promotions'] as $promotion): ?>
                    <option value="<?= $promotion->getId() ?>">P<?= $promotion->getYear() ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="btn-submit" name="method" value="add">Valider</button>
        </div>

    </form>
</div>


<!-- Modifier -->
<div class="menu menu-edit">
    <form method="post">
        
        <div class="menu-title">
            Modifier un groupe
        </div>

        <!-- On choisis celui a modifier -->
        <div class="menu-select">
            <select name="edit">
                <option value="0">Sélectionnez un groupe</option>
                <?php foreach ($data['groups'] as $title => $groups): ?>
                    <optgroup label="<?= $title ?>"></optgroup>
                    <?php foreach ($groups as $group): ?>
                        <option value="<?= $group->getId() ?>" <?= (isset($data['values']) and $data['values']['group']->getId() === $group->getId()) ? 'selected' : '' ?>>G<?= $group->getIndex() ?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- 1. On clique sur modifier -->
        <button type="submit" class="btn-submit" name="method" value="retrieve">Modifier</button>

        <?php if (isset($data['values'])): ?>

            <!-- 2. Ca charge les données dans le formulaire -->
            <div class="menu-hidden">

                <input type="number" name="index" class="menu-input" placeholder="Index du groupe (Ex: Pour G1 entrez 1)" value="<?= $data['values']['group']->getIndex() ?>">
        
                <select name="promotion" class="menu-select">
                    <?php foreach ($data['promotions'] as $promotion): ?>
                        <option value="<?= $promotion->getId() ?>" <?= $data['values']['promotion'] === $promotion->getId() ? 'selected' : '' ?>>P<?= $promotion->getYear() ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="hidden" name="update" value="<?= $data['values']['group']->getId() ?>">

                <button type="submit" class="btn-submit" name="method" value="update">Valider</button>
            </div>

        <?php endif; ?>

    </form>
</div>



<div class="menu menu-delete">
    <form method="post">
    
        <div class="menu-title">
            Supprimer un groupe
        </div>

        <!-- On choisis celui a supprimer -->
        <div class="menu-select">
            <select name="delete">
                <option value="0">Sélectionnez un groupe</option>
                <?php foreach ($data['groups'] as $title => $groups): ?>
                    <optgroup label="<?= $title ?>"></optgroup>
                    <?php foreach ($groups as $group): ?>
                        <option value="<?= $group->getId() ?>">G<?= $group->getIndex() ?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn-submit" name="method" value="delete">Valider</button>

    </form>
</div>

