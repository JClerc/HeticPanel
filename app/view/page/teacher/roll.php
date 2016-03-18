
<!-- TODO: Javascript pour passer au suivant -->

<?php $this->view('module/includes/navbar') ?>

<?php $data['flash']->display() ?>

<!-- Formulaire a envoyer une fois l'appel terminé -->
<!-- -> $(form).submit() -->
<form method="post">

    <!-- index = index de l'éleve dans la liste -->
    <!-- A utiliser pour passer au suivant -->
    <div class="student current" data-index="0">
        <div class="name">
            <!-- Le nom de l'élève -->
            Bastien BERGAGLIA
        </div>
        <div class="hidden">
            <!-- Case a cocher ou pas en Javascript -->
            <!-- "value" sera préremplis en PHP -->
            <input type="checkbox" value="4" name="absences[]">
        </div>
    </div>
    
    <div class="student next" data-index="1">
        <div class="name">
            Jonathan CLERC
        </div>
        <div class="hidden">
            <input type="checkbox" value="7" name="absences[]">
        </div>
    </div>

    <div class="student" data-index="2">
        <div class="name">
            Ronan FOURREAU
        </div>
        <div class="hidden">
            <input type="checkbox" value="8" name="absences[]">
        </div>
    </div>

</form>
