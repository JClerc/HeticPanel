
<?php $this->view('module/includes/navbar') ?>

<section class="container">
    <?php $data['flash']->display() ?>

    <h3 class="title">Gérer les cours</h3>
    
    <div class="course-list">
        <!-- Ajouter -->
        <div class="dashbox nopadding menu menu-add">
            <!-- Quand on clic la dessus, ca affiche le formulaire -->
            <a href="#" class="item missing" onclick="$('#add').toggle();">
                Ajouter un cours
            </a>
        </div><br>

        <!-- Modifier -->
        <div class="dashbox nopadding menu menu-edit">
            <div class="item parent menu-title">
                Modifier un cours
            </div>
            
            <form method="post">
                <!-- On choisis celui a modifier -->
                <div class="item menu-select">
                    <select name="edit" style="width: 100%;">
                        <option value="0">Sélectionnez un cours</option>
                        <?php foreach ($data['courses'] as $title => $courses): ?>
                            <optgroup label="<?= $title ?>"></optgroup>
                            <?php foreach ($courses as $course): ?>
                                <option value="<?= $course->getId() ?>" <?= (isset($data['values']) and $data['values']['course']->getId() === $course->getId()) ? 'selected' : '' ?>><?= $course->get('name') ?></option>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="item" style="margin-top: -20px; height: 80px">
                    <center>
                        <button type="submit" class="absence-submit btn-submit" style="margin-top:0px" name="method" value="retrieve">Modifier</button>
                    </center>
                </div>
            </form>
        </div><br>


        <div class="dashbox menu menu-delete">
            <form method="post">
            
                <div class="item parent menu-title">
                    Supprimer un cours
                </div>

                <!-- On choisis celui a supprimer -->
                <div class="item menu-select">
                    <select name="delete" style="width: 100%">
                        <option value="0">Sélectionnez un cours</option>
                        <?php foreach ($data['courses'] as $title => $courses): ?>
                            <optgroup label="<?= $title ?>"></optgroup>
                            <?php foreach ($courses as $course): ?>
                                <option value="<?= $course->getId() ?>"><?= $course->get('name') ?></option>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="item" style="margin-top: -20px; height: 65px">
                    <center>
                        <button type="submit" class="absence-submit btn-submit" style="margin-top:0" name="method" value="delete">Supprimer</button>
                    </center>
                </div>
            </form>
        </div>

        <br>
    </div>

    <div class="calendar dashbox">
        <form method="post" id="add" class="menu-hidden" style="<?= (isset($data['method-add']) and $data['method-add']) ? '' : 'display: none;' ?>">
            <h3>Ajouter un cours</h3>
            
            <div class="form-container">
                <div class="form-item">
                    <label>Nom du cours</label><br>
                    <input type="text" name="name" class="menu-input" placeholder="Nom du cours (Ex: Anglais)">
                    <br><br>

                    <label>Code du cours</label><br>
                    <input type="text" name="code" class="menu-input" placeholder="Code du cours (Ex: ENG)">
                    <br><br>

                    <label>Professeur</label><br>
                    <select name="teacher" class="menu-select">
                        <?php foreach ($data['teachers'] as $teacher): ?>
                            <option value="<?= $teacher->getId() ?>"><?= $teacher->get('firstname') ?> <?= $teacher->get('lastname') ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br><br>
                </div>

                <div class="form-item">
                    <label>Groupe</label><br>
                    <select name="group" class="menu-select">
                        <?php foreach ($data['groups'] as $title => $groups): ?>
                            <optgroup label="<?= $title ?>"></optgroup>
                            <?php foreach ($groups as $group): ?>
                                <option value="<?= $group->getId() ?>">G<?= $group->getIndex() ?></option>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </select>
                    <br><br>
                    
                    <label>Premier cours</label><br>
                    <input type="date" name="startdate" class="menu-input" placeholder="__/__/____">
                    <br><br>
                    
                    <label>Dernier cours</label><br>
                    <input type="date" name="enddate" class="menu-input" placeholder="__/__/____">
                </div>

                <div class="form-item">                    
                    <label>Début des cours</label><br>
                    <select name="starttime" class="menu-select">
                        <?php for ($i = 0; $i < 24; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?>h00</option>
                        <?php endfor; ?>
                    </select>
                    <br><br>
                    
                    <label>Fin des cours</label><br>
                    <select name="endtime" class="menu-select">
                        <?php for ($i = 1; $i <= 24; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?>h00</option>
                        <?php endfor; ?>
                    </select>
                    <br><br>
                    
                    <label>Jour des cours</label><br>
                    <select name="dayofweek" class="menu-select">
                        <?php for ($i = 1; $i < count(Calendar::DAY_LOCALE_FR); $i++): ?>                    
                            <option value="<?= $i ?>"><?= Calendar::DAY_LOCALE_FR[$i] ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <center>
                <button type="submit" class="absence-submit btn-submit" name="method" value="add">Valider</button>
            </center>
        </form>

        <?php if (isset($data['values'])): ?>
            <h3>Modifier un cours</h3>

            <form method="post" class="menu-hidden">
                <select name="edit" style="display: none">
                    <option value="0">Sélectionnez un cours</option>
                    <?php foreach ($data['courses'] as $title => $courses): ?>
                        <optgroup label="<?= $title ?>"></optgroup>
                        <?php foreach ($courses as $course): ?>
                            <option value="<?= $course->getId() ?>" <?= (isset($data['values']) and $data['values']['course']->getId() === $course->getId()) ? 'selected' : '' ?>><?= $course->get('name') ?></option>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </select>
                
                <div class="form-container">
                    <div class="form-item">
                        <label>Nom du cours</label><br>
                        <input type="text" name="name" class="menu-input" placeholder="Nom du cours (Ex: Anglais)" value="<?= $data['values']['name'] ?>">
                        <br><br>

                        <label>Code du cours</label><br>
                        <input type="text" name="code" class="menu-input" placeholder="Code du cours (Ex: ENG)" value="<?= $data['values']['code'] ?>">
                        <br><br>

                        <label>Professeur</label><br>
                        <select name="teacher" class="menu-select">
                            <?php foreach ($data['teachers'] as $teacher): ?>
                                <option value="<?= $teacher->getId() ?>" <?= $data['values']['teacher'] === $teacher->getId() ? 'selected' : '' ?>><?= $teacher->get('firstname') ?> <?= $teacher->get('lastname') ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br><br>
                    </div>

                    <div class="form-item">
                        <label>Groupe</label><br>
                        <select name="group" class="menu-select">
                            <?php foreach ($data['groups'] as $title => $groups): ?>
                                <optgroup label="<?= $title ?>"></optgroup>
                                <?php foreach ($groups as $group): ?>
                                    <option value="<?= $group->getId() ?>" <?= $data['values']['group'] === $group->getId() ? 'selected' : '' ?>>G<?= $group->getIndex() ?></option>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </select>
                        <br><br>
                    
                        <label>Premier cours</label><br>
                        <input type="date" name="startdate" class="menu-input" placeholder="__/__/____" value="<?= $data['values']['startdate'] ?>">
                        <br><br>

                        <label>Dernier cours</label><br>
                        <input type="date" name="enddate" class="menu-input" placeholder="__/__/____" value="<?= $data['values']['enddate'] ?>">
                        <br><br>
                    </div>

                    <div class="form-item">
                        <label>Début des cours</label><br>
                        <select name="starttime" class="menu-select">
                            <?php for ($i = 0; $i < 24; $i++): ?>
                                <option value="<?= $i ?>" <?= $data['values']['starttime'] === $i * 3600 ? 'selected' : '' ?>><?= $i ?>h00</option>
                            <?php endfor; ?>
                        </select>
                        <br><br>
                        
                        <label>Fin des cours</label><br>
                        <select name="endtime" class="menu-select">
                            <?php for ($i = 1; $i <= 24; $i++): ?>
                                <option value="<?= $i ?>" <?= $data['values']['endtime'] === $i * 3600 ? 'selected' : '' ?>><?= $i ?>h00</option>
                            <?php endfor; ?>
                        </select>
                        <br><br>
                        
                        <label>Jour des cours</label><br>
                        <select name="dayofweek" class="menu-select">
                            <?php for ($i = 1; $i < count(Calendar::DAY_LOCALE_FR); $i++): ?>
                                <option value="<?= $i ?>" <?= $data['values']['dayofweek'] === $i ? 'selected' : '' ?>><?= Calendar::DAY_LOCALE_FR[$i] ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <input type="hidden" name="update" value="<?= $data['values']['course']->getId() ?>">
                <center>
                    <button type="submit" class="absence-submit btn-submit" name="method" value="update">Valider</button>
                </center>
            </form>
        <?php endif; ?>
    </div>
</section>
