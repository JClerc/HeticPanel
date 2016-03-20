
<?php $this->view('module/includes/navbar') ?>

<section class="container">
    <?php $data['flash']->display() ?>

    <h3 class="title">Gérer les promotions</h3>
    
    <div class="course-list">
        <!-- Ajouter -->
        <div class="dashbox nopadding menu menu-add">
            <a href="#" class="item missing menu-title" onclick="$('#add').toggle();">
                Ajouter une promotion
            </a>
        </div><br>

        <!-- Modifier -->
        <div class="dashbox nopadding menu menu-edit">
            <form method="post">
                
                <div class="item parent menu-title">
                    Modifier une promotion
                </div>

                <div class="item menu-select">
                    <select name="edit" style="width: 100%">
                        <option value="0">Sélectionnez une promotion</option>
                        <?php foreach ($data['promotions'] as $promotion): ?>
                            <option value="<?= $promotion->getId() ?>" <?= (isset($data['values']) and $data['values']['promotion']->getId() === $promotion->getId()) ? 'selected' : '' ?>>P<?= $promotion->getYear() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="item" style="margin-top: -20px; height: 80px">
                    <center>
                        <button type="submit" class="absence-submit btn-submit" style="margin-top: 0" name="method" value="retrieve">Modifier</button>
                    </center>
                </div>
            </form>
        </div><br>

        <div class="dashbox nopadding menu menu-delete">
            <form method="post">
                <div class="item parent menu-title">
                    Supprimer une promotion
                </div>

                <div class="item menu-select">
                    <select name="delete" style="width: 100%">
                        <option value="0">Sélectionnez une promotion</option>
                        <?php foreach ($data['promotions'] as $promotion): ?>
                            <option value="<?= $promotion->getId() ?>">P<?= $promotion->getYear() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="item" style="margin-top: -20px; height: 80px">
                    <center>
                        <button type="submit" class="absence-submit btn-submit" style="margin-top: 0" name="method" value="delete">Valider</button>
                    </center>
                </div>
            </form>
        </div><br>
    </div>

    <div class="dashbox calendar">
        <form method="post" id="add" class="menu-hidden" style="<?= (isset($data['method-add']) and $data['method-add']) ? '' : 'display: none;' ?>">
            <h3>Ajouter une promotion</h3>

            <label>Année de promotion</label><br>
            <input type="number" name="year" class="menu-input" placeholder="Année (Ex: Pour P2019 entrez 2019)" value="<?= date('Y') ?>">
            <br><br>

            <center>
                <button type="submit" class="absence-submit btn-submit" name="method" value="add">Valider</button>
            </center>
        </form>
        
        <?php if (isset($data['values'])): ?>
        <form method="post" class="menu-hidden">  
            <h3>Modifier une promotion</h3>

            <select name="edit" style="width: 100%; display: none">
                <option value="0">Sélectionnez une promotion</option>
                <?php foreach ($data['promotions'] as $promotion): ?>
                    <option value="<?= $promotion->getId() ?>" <?= (isset($data['values']) and $data['values']['promotion']->getId() === $promotion->getId()) ? 'selected' : '' ?>>P<?= $promotion->getYear() ?></option>
                <?php endforeach; ?>
            </select>

            <label>Année de promotion</label><br>
            <input type="number" name="year" class="menu-input" placeholder="Année (Ex: Pour P2019 entrez 2019)" value="<?= $data['values']['promotion']->getYear() ?>">

            <input type="hidden" name="update" value="<?= $data['values']['promotion']->getId() ?>">
            <center>
                <button type="submit" class="absence-submit btn-submit" name="method" value="add">Valider</button>
            </center>
        </form>
        <?php endif; ?>
    </div>
</section>
