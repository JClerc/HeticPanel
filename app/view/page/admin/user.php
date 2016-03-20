
<?php $this->view('module/includes/navbar') ?>

<section class="container">
    <?php $data['flash']->display() ?>

    <h3 class="title">Gérer les utilisateurs</h3>
    
    <div class="course-list">
        <!-- Ajouter -->
        <div class="dashbox nopadding menu menu-add">
            <a href="#" class="item missing menu-title" onclick="$('#add').toggle();">
                Ajouter un utilisateur
            </a>
        </div><br>


        <!-- Modifier -->
        <div class="dashbox nopadding menu menu-edit">
            <form method="post">
                
                <div class="item parent menu-title">
                    Modifier un utilisateur
                </div>

                <div class="item menu-select">
                    <select name="edit">
                        <option value="0">Sélectionnez un utilisateur</option>
                        <?php foreach ($data['users'] as $title => $users): ?>
                            <optgroup label="<?= $title ?>">
                            <?php foreach ($users as $user): ?>
                                <option value="<?= $user->getId() ?>" <?= (isset($data['values']) and $data['values']['user']->getId() === $user->getId()) ? 'selected' : '' ?>><?= $user->get('lastname') ?> <?= $user->get('firstname') ?></option>
                            <?php endforeach; ?>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="item" style="height: 80px; margin-top: -20px">
                    <center>
                        <button type="submit" class="absence-submit btn-submit" style="margin-top: 0" name="method" value="retrieve">Modifier</button>
                    </center>
                </div>
            </form>
        </div><br>



        <div class="dashbox nopadding menu menu-delete">
            <form method="post">
                <div class="item parent menu-title">
                    Supprimer un utilisateur
                </div>

                <!-- On choisis celui a supprimer -->
                <div class="item menu-select">
                    <select name="delete">
                        <option value="0">Sélectionnez un utilisateur</option>
                        <?php foreach ($data['users'] as $title => $users): ?>
                            <optgroup label="<?= $title ?>">
                            <?php foreach ($users as $user): ?>
                                <option value="<?= $user->getId() ?>" <?= (isset($data['values']) and $data['values']['user']->getId() === $user->getId()) ? 'selected' : '' ?>><?= $user->get('lastname') ?> <?= $user->get('firstname') ?></option>
                            <?php endforeach; ?>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="item" style="height: 80px; margin-top: -20px;">
                    <center>
                        <button type="submit" class="absence-submit btn-submit" style="margin-top: 0" name="method" value="delete">Valider</button>
                    </center>
                </div>

            </form>
        </div><br>
    </div>

    <div class="calendar dashbox">
        <form method="post" id="add" class="menu-hidden" style="<?= (isset($data['method-add']) and $data['method-add']) ? '' : 'display: none;' ?>">
            <h3>Ajouter un utilisateur</h3>

            <div class="form-container"> 
                <div class="form-item">
                    <label>Nom d'utilisateur</label><br>
                    <input type="text" name="username" class="menu-input" placeholder="Nom d'utilisateur">
                    <br><br>

                    <label>Mot de passe</label><br>
                    <input type="password" name="password" class="menu-input" placeholder="Mot de passe">
                    <br><br>

                    <label>Email</label><br>
                    <input type="email" name="email" class="menu-input" placeholder="Email">
                    <br><br>

                    <label>Prénom</label><br>
                    <input type="text" name="firstname" class="menu-input" placeholder="Prénom">
                </div>

                <div class="form-item">
                    <label>Nom</label><br>
                    <input type="text" name="lastname" class="menu-input" placeholder="Nom de famille">
                    <br><br>

                    <label>Type</label><br>
                    <select name="permission" class="menu-select">
                        <option value="1">Étudiant</option>
                        <option value="2">Professeur</option>
                        <option value="3">Administrateur</option>
                    </select>
                    <br><br>

                    <label>Groupe</label><br>
                    <select name="group" class="menu-select">
                        <option value="0">Aucun groupe</option>
                        <?php foreach ($data['groups'] as $title => $groups): ?>
                            <optgroup label="<?= $title ?>">
                            <?php foreach ($groups as $group): ?>
                                <option value="<?= $group->getId() ?>">G<?= $group->getIndex() ?></option>
                            <?php endforeach; ?>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <center>
                <button type="submit" class="absence-submit btn-submit" name="method" value="add">Valider</button>
            </center>
        </form>

        <?php if (isset($data['values'])): ?>
        <form method="post" class="menu-hidden">
            <h3>Modifier un utilisateur</h3>

            <select name="edit" style="display: none;">
                <option value="0">Sélectionnez un utilisateur</option>
                <?php foreach ($data['users'] as $title => $users): ?>
                    <optgroup label="<?= $title ?>">
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user->getId() ?>" <?= (isset($data['values']) and $data['values']['user']->getId() === $user->getId()) ? 'selected' : '' ?>><?= $user->get('lastname') ?> <?= $user->get('firstname') ?></option>
                    <?php endforeach; ?>
                    </optgroup>
                <?php endforeach; ?>
            </select>

            <div class="form-container">
                <div class="form-item">
                    <label>Nom d'utilisateur</label><br>
                    <input type="text" name="username" class="menu-input" placeholder="Nom d'utilisateur" value="<?= $data['values']['user']->get('username') ?>">
                    <br><br>

                    <label>Mot de passe</label><br>
                    <input type="password" name="password" class="menu-input" placeholder="Mot de passe" value="">
                    <br><br>

                    <label>Email</label><br>
                    <input type="email" name="email" class="menu-input" placeholder="Email" value="<?= $data['values']['user']->get('email') ?>">
                    <br><br>

                    <label>Prénom</label><br>
                    <input type="text" name="firstname" class="menu-input" placeholder="Prénom" value="<?= $data['values']['user']->get('firstname') ?>">
                </div>
                
                <div class="form-item">
                    <label>Nom</label><br>
                    <input type="text" name="lastname" class="menu-input" placeholder="Nom de famille" value="<?= $data['values']['user']->get('lastname') ?>">
                    <br><br>

                    <label>Type</label><br>
                    <select name="permission" class="menu-select">
                        <option value="1" <?= $data['values']['user']->get('permission') == 1 ? 'selected' : '' ?>>Étudiant</option>
                        <option value="2" <?= $data['values']['user']->get('permission') == 2 ? 'selected' : '' ?>>Professeur</option>
                        <option value="3" <?= $data['values']['user']->get('permission') == 3 ? 'selected' : '' ?>>Administrateur</option>
                    </select>
                    <br><br>

                    <label>Groupe</label><br>
                    <select name="group" class="menu-select">
                        <option value="0">Aucun groupe</option>
                        <?php foreach ($data['groups'] as $title => $groups): ?>
                            <optgroup label="<?= $title ?>">
                            <?php foreach ($groups as $group): ?>
                                <option value="<?= $group->getId() ?>" <?= $data['values']['user']->getGroup()->equals($group) ? 'selected' : '' ?>>G<?= $group->getIndex() ?></option>
                            <?php endforeach; ?>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <center>
                <button type="submit" class="absence-submit btn-submit" name="method" value="update">Valider</button>
            </center>
        </form>
        <?php endif; ?>
    </div>
</section>
