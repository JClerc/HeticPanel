
<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>


<!-- Ajouter -->
<div class="menu menu-add">
    <form method="post">
    
        <!-- Quand on clic la dessus, ca affiche le formulaire -->
        <a href="#" class="menu-title" onclick="$(this).parent().find('.menu-hidden').toggle();">
            Ajouter un utilisateur
        </a>

        <div class="menu-hidden" style="display: none;">
            <input type="text" name="____" class="menu-input">
            <button type="submit" class="btn-submit">Valider</button>
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
                <option value="_____"></option>
            </select>
        </div>

        <!-- 1. On clique sur modifier -->
        <button type="submit" class="btn-submit">Modifier</button>

        <!-- 2. Ca charge les données dans le formulaire -->
        <div class="menu-hidden" style="display: none;">
            <input type="text" name="____" class="menu-input">
            <button type="submit" class="btn-submit">Valider</button>
        </div>

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
                <option value="_____"></option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Valider</button>

    </form>
</div>

