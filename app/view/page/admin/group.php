
<?php $this->view('module/includes/navbar') ?>

<section class="container">
    <?php $data['flash']->display() ?>

    <h3 class="title">Gérer les cours</h3>
    
    <div class="course-list">
        <!-- Ajouter -->
        <div class="dashbox nopadding menu menu-add">
            <!-- Quand on clic la dessus, ca affiche le formulaire -->
            <a href="#" class="item missing menu-title" onclick="$('#add').toggle();">
                Ajouter un groupe
            </a>
        </div><br>


        <!-- Modifier -->
        <div class="dashbox nopadding menu menu-edit">
            <form method="post">
                <div class="item parent menu-title">
                    Modifier un groupe
                </div>

                <!-- On choisis celui a modifier -->
                <div class="item menu-select">
                    <select name="edit" style="width: 100%">
                        <option value="0">Sélectionnez un groupe</option>
                        <?php foreach ($data['groups'] as $title => $groups): ?>
                            <optgroup label="<?= $title ?>">
                            <?php foreach ($groups as $group): ?>
                                <option value="<?= $group->getId() ?>" <?= (isset($data['values']) and $data['values']['group']->getId() === $group->getId()) ? 'selected' : '' ?>>G<?= $group->getIndex() ?></option>
                            <?php endforeach; ?>
                            </optgroup>
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
                    Supprimer un groupe
                </div>

                <!-- On choisis celui a supprimer -->
                <div class="item menu-select">
                    <select name="delete">
                        <option value="0">Sélectionnez un groupe</option>
                        <?php foreach ($data['groups'] as $title => $groups): ?>
                            <optgroup label="<?= $title ?>">
                            <?php foreach ($groups as $group): ?>
                                <option value="<?= $group->getId() ?>">G<?= $group->getIndex() ?></option>
                            <?php endforeach; ?>
                            </optgroup>
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

    <div class="calendar dashbox">
        <form method="post" id="add" class="menu-hidden" style="<?= (isset($data['method-add']) and $data['method-add']) ? '' : 'display: none;' ?>">
            <h3>Ajouter un groupe</h3>

            <div class="form-container">
                <div class="form-item">
                    <label>Index du groupe</label><br>
                    <input type="number" name="index" class="menu-input" placeholder="Index du groupe (Ex: Pour G1 entrez 1)" value="1">
                    <br><br>
                    
                    <label>Promotion</label><br>
                    <select name="promotion" class="menu-select">
                        <?php foreach ($data['promotions'] as $promotion): ?>
                            <option value="<?= $promotion->getId() ?>">P<?= $promotion->getYear() ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br><br>
                </div>
                <div class="form-item">&nbsp;</div>
                <div class="form-item">&nbsp;</div>
            </div>

            <center>
                <button type="submit" class="absence-submit btn-submit" name="method" value="add">Valider</button>
            </center>
        </form>

        <?php if (isset($data['values'])): ?>
            <form method="post" class="menu-hidden">
                <h3>Modifier le groupe</h3>

                <select name="edit" style="display: none;">
                    <option value="0">Sélectionnez un groupe</option>
                    <?php foreach ($data['groups'] as $title => $groups): ?>
                        <optgroup label="<?= $title ?>">
                        <?php foreach ($groups as $group): ?>
                            <option value="<?= $group->getId() ?>" <?= (isset($data['values']) and $data['values']['group']->getId() === $group->getId()) ? 'selected' : '' ?>>G<?= $group->getIndex() ?></option>
                        <?php endforeach; ?>
                        </optgroup>
                    <?php endforeach; ?>
                </select>

                <div class="form-container">
                    <div class="form-item">
                        <label>Index du groupe</label><br>
                        <input type="number" name="index" class="menu-input" placeholder="Index du groupe (Ex: Pour G1 entrez 1)" value="<?= $data['values']['group']->getIndex() ?>">
                        <br><br>

                        <label>Promotion</label><br>
                        <select name="promotion" class="menu-select">
                            <?php foreach ($data['promotions'] as $promotion): ?>
                                <option value="<?= $promotion->getId() ?>" <?= $data['values']['promotion'] === $promotion->getId() ? 'selected' : '' ?>>P<?= $promotion->getYear() ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br><br>
                    </div>
                    <div class="form-item">&nbsp;</div>
                    <div class="form-item">&nbsp;</div>
                </div>

                <input type="hidden" name="update" value="<?= $data['values']['group']->getId() ?>">
                
                <center>
                    <button type="submit" class="absence-submit btn-submit" name="method" value="update">Valider</button>
                </center>
            </form>
        <?php endif; ?>
    </div>
</section>

