
<!-- Aucun JS a faire pour cette page, juste de l'inté -->

<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>

Cochez uniquement les absences

<form method="post">

    <div class="student">
        <label for="student-1" class="name">Bastien BERGAGLIA</label>
        <div class="checkbox">
            <input id="student-1" type="checkbox" value="1" name="absences[]">
        </div>
    </div>
    
    <div class="student">
        <label for="student-2" class="name">Jonathan CLERC</label>
        <div class="checkbox">
            <input id="student-2" type="checkbox" value="2" name="absences[]">
        </div>
    </div>

    <div class="send">
        <button type="submit">Valider</button>
    </div>
    
</form>
