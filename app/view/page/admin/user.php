
<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>


<!-- Ajouter -->
<div class="menu menu-add">
    <form method="post">
    
        <!-- Quand on clic la dessus, ca affiche le formulaire -->
        <a href="#" class="menu-title" onclick="$(this).parent().find('.menu-hidden').toggle();">
            Ajouter un utilisateur
        </a>

        <div class="menu-hidden" style="<?= (isset($data['method-add']) and $data['method-add']) ? '' : 'display: none;' ?>">

            <input type="text" name="username" class="menu-input" placeholder="Nom d'utilisateur">
            <input type="password" name="password" class="menu-input" placeholder="Mot de passe">
            <input type="email" name="email" class="menu-input" placeholder="Email">
            <input type="text" name="firstname" class="menu-input" placeholder="Prénom">
            <input type="text" name="lastname" class="menu-input" placeholder="Nom de famille">

            <select name="permission" class="menu-select">
                <option value="1">Étudiant</option>
                <option value="2">Professeur</option>
                <option value="3">Administrateur</option>
            </select>

            <select name="group" class="menu-select">
                <option value="0">Aucun groupe</option>
                <?php foreach ($data['groups'] as $title => $groups): ?>
                    <optgroup label="<?= $title ?>"></optgroup>
                    <?php foreach ($groups as $group): ?>
                        <option value="<?= $group->getId() ?>">G<?= $group->getIndex() ?></option>
                    <?php endforeach; ?>
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
            Modifier un utilisateur
        </div>

        <!-- On choisis celui a modifier -->
        <div class="menu-select">
            <select name="edit">
                <option value="0">Sélectionnez un utilisateur</option>
                <?php foreach ($data['users'] as $title => $users): ?>
                    <optgroup label="<?= $title ?>"></optgroup>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user->getId() ?>" <?= (isset($data['values']) and $data['values']['user']->getId() === $user->getId()) ? 'selected' : '' ?>><?= $user->get('lastname') ?> <?= $user->get('firstname') ?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- 1. On clique sur modifier -->
        <button type="submit" class="btn-submit" name="method" value="retrieve">Modifier</button>

        <?php if (isset($data['values'])): ?>

            <!-- 2. Ca charge les données dans le formulaire -->
            <div class="menu-hidden">

                <input type="text" name="username" class="menu-input" placeholder="Nom d'utilisateur" value="<?= $data['values']['user']->get('username') ?>">
                <input type="password" name="password" class="menu-input" placeholder="Mot de passe" value="">
                <input type="email" name="email" class="menu-input" placeholder="Email" value="<?= $data['values']['user']->get('email') ?>">
                <input type="text" name="firstname" class="menu-input" placeholder="Prénom" value="<?= $data['values']['user']->get('firstname') ?>">
                <input type="text" name="lastname" class="menu-input" placeholder="Nom de famille" value="<?= $data['values']['user']->get('lastname') ?>">

                <select name="permission" class="menu-select">
                    <option value="1" <?= $data['values']['user']->get('permission') == 1 ? 'selected' : '' ?>>Étudiant</option>
                    <option value="2" <?= $data['values']['user']->get('permission') == 2 ? 'selected' : '' ?>>Professeur</option>
                    <option value="3" <?= $data['values']['user']->get('permission') == 3 ? 'selected' : '' ?>>Administrateur</option>
                </select>

                <select name="group" class="menu-select">
                    <option value="0">Aucun groupe</option>
                    <?php foreach ($data['groups'] as $title => $groups): ?>
                        <optgroup label="<?= $title ?>"></optgroup>
                        <?php foreach ($groups as $group): ?>
                            <option value="<?= $group->getId() ?>" <?= $data['values']['user']->getGroup()->equals($group) ? 'selected' : '' ?>>G<?= $group->getIndex() ?></option>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </select>

                <button type="submit" class="btn-submit" name="method" value="update">Valider</button>
            </div>

        <?php endif; ?>

    </form>
</div>



<div class="menu menu-delete">
    <form method="post">
    
        <div class="menu-title">
            Supprimer un utilisateur
        </div>

        <!-- On choisis celui a supprimer -->
        <div class="menu-select">
            <select name="delete">
                <option value="0">Sélectionnez un utilisateur</option>
                <?php foreach ($data['users'] as $title => $users): ?>
                    <optgroup label="<?= $title ?>"></optgroup>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user->getId() ?>" <?= (isset($data['values']) and $data['values']['user']->getId() === $user->getId()) ? 'selected' : '' ?>><?= $user->get('lastname') ?> <?= $user->get('firstname') ?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn-submit" name="method" value="delete">Valider</button>

    </form>
</div>

