
<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>


<!-- Ajouter -->
<div class="menu menu-add">
    <form method="post">
    
        <!-- Quand on clic la dessus, ca affiche le formulaire -->
        <a href="#" class="menu-title" onclick="$(this).parent().find('.menu-hidden').toggle();">
            Ajouter un cours
        </a>

        <div class="menu-hidden" style="<?= (isset($data['method-add']) and $data['method-add']) ? '' : 'display: none;' ?>">

            <input type="text" name="name" class="menu-input" placeholder="Nom du cours (Ex: Anglais)">

            <input type="text" name="code" class="menu-input" placeholder="Code du cours (Ex: ENG)">

            <select name="teacher" class="menu-select">
                <?php foreach ($data['teachers'] as $teacher): ?>
                    <option value="<?= $teacher->getId() ?>"><?= $teacher->get('firstname') ?> <?= $teacher->get('lastname') ?></option>
                <?php endforeach; ?>
            </select>

            <select name="group" class="menu-select">
                <?php foreach ($data['groups'] as $title => $groups): ?>
                    <optgroup label="<?= $title ?>"></optgroup>
                    <?php foreach ($groups as $group): ?>
                        <option value="<?= $group->getId() ?>">G<?= $group->getIndex() ?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>

            <input type="date" name="startdate" class="menu-input" placeholder="__/__/____">

            <input type="date" name="enddate" class="menu-input" placeholder="__/__/____">

            <select name="starttime" class="menu-select">
                <?php for ($i = 0; $i < 24; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?>h00</option>
                <?php endfor; ?>
            </select>

            <select name="endtime" class="menu-select">
                <?php for ($i = 1; $i <= 24; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?>h00</option>
                <?php endfor; ?>
            </select>

            <select name="dayofweek" class="menu-select">
                <?php for ($i = 1; $i < count(Calendar::DAY_LOCALE_FR); $i++): ?>                    
                    <option value="<?= $i ?>"><?= Calendar::DAY_LOCALE_FR[$i] ?></option>
                <?php endfor; ?>
            </select>

            <button type="submit" class="btn-submit" name="method" value="add">Valider</button>
        </div>

    </form>
</div>


<!-- Modifier -->
<div class="menu menu-edit">
    <form method="post">
        
        <div class="menu-title">
            Modifier un cours
        </div>

        <!-- On choisis celui a modifier -->
        <div class="menu-select">
            <select name="edit">
                <option value="0">Sélectionnez un cours</option>
                <?php foreach ($data['courses'] as $title => $courses): ?>
                    <optgroup label="<?= $title ?>"></optgroup>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?= $course->getId() ?>" <?= (isset($data['values']) and $data['values']['course']->getId() === $course->getId()) ? 'selected' : '' ?>><?= $course->get('name') ?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- 1. On clique sur modifier -->
        <button type="submit" class="btn-submit" name="method" value="retrieve">Modifier</button>

        <?php if (isset($data['values'])): ?>

            <!-- 2. Ca charge les données dans le formulaire -->
            <div class="menu-hidden">
                <input type="text" name="name" class="menu-input" placeholder="Nom du cours (Ex: Anglais)" value="<?= $data['values']['name'] ?>">
                
                <input type="text" name="code" class="menu-input" placeholder="Code du cours (Ex: ENG)" value="<?= $data['values']['code'] ?>">
                
                <select name="teacher" class="menu-select">
                    <?php foreach ($data['teachers'] as $teacher): ?>
                        <option value="<?= $teacher->getId() ?>" <?= $data['values']['teacher'] === $teacher->getId() ? 'selected' : '' ?>><?= $teacher->get('firstname') ?> <?= $teacher->get('lastname') ?></option>
                    <?php endforeach; ?>
                </select>
                
                <select name="group" class="menu-select">
                    <?php foreach ($data['groups'] as $title => $groups): ?>
                        <optgroup label="<?= $title ?>"></optgroup>
                        <?php foreach ($groups as $group): ?>
                            <option value="<?= $group->getId() ?>" <?= $data['values']['group'] === $group->getId() ? 'selected' : '' ?>>G<?= $group->getIndex() ?></option>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </select>

                <input type="date" name="startdate" class="menu-input" placeholder="__/__/____" value="<?= $data['values']['startdate'] ?>">
                
                <input type="date" name="enddate" class="menu-input" placeholder="__/__/____" value="<?= $data['values']['enddate'] ?>">
                
                <select name="starttime" class="menu-select">
                    <?php for ($i = 0; $i < 24; $i++): ?>
                        <option value="<?= $i ?>" <?= $data['values']['starttime'] === $i * 3600 ? 'selected' : '' ?>><?= $i ?>h00</option>
                    <?php endfor; ?>
                </select>
                
                <select name="endtime" class="menu-select">
                    <?php for ($i = 1; $i <= 24; $i++): ?>
                        <option value="<?= $i ?>" <?= $data['values']['endtime'] === $i * 3600 ? 'selected' : '' ?>><?= $i ?>h00</option>
                    <?php endfor; ?>
                </select>
                
                <select name="dayofweek" class="menu-select">
                    <?php for ($i = 1; $i < count(Calendar::DAY_LOCALE_FR); $i++): ?>
                        <option value="<?= $i ?>" <?= $data['values']['dayofweek'] === $i ? 'selected' : '' ?>><?= Calendar::DAY_LOCALE_FR[$i] ?></option>
                    <?php endfor; ?>
                </select>

                <input type="hidden" name="update" value="<?= $data['values']['course']->getId() ?>">

                <button type="submit" class="btn-submit" name="method" value="update">Valider</button>
            </div>

        <?php endif; ?>

    </form>
</div>



<div class="menu menu-delete">
    <form method="post">
    
        <div class="menu-title">
            Supprimer un cours
        </div>

        <!-- On choisis celui a supprimer -->
        <div class="menu-select">
            <select name="delete">
                <option value="0">Sélectionnez un cours</option>
                <?php foreach ($data['courses'] as $title => $courses): ?>
                    <optgroup label="<?= $title ?>"></optgroup>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?= $course->getId() ?>"><?= $course->get('name') ?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn-submit" name="method" value="delete">Valider</button>

    </form>
</div>

