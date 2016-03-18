

<!-- Formulaire a envoyer une fois l'appel terminé -->
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
            <!-- value=1 sera préremplis en PHP -->
            <input type="checkbox" value="1" name="absences[]">
        </div>
    </div>
    
    <div class="student" data-index="1">
        <div class="name">
            Jonathan CLERC
        </div>
        <div class="hidden">
            <input type="checkbox" value="2" name="absences[]">
        </div>
    </div>

</form>
