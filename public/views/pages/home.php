<?php ob_start(); ?>

<!-- self-note:
- ne pas oublier d'extraire la db
- composer install
- créer une page qui affiche la liste des requetes
- modif' db à faire - voir slack 
 -->




 <!-- Points de cardinalités: 
    - un véhicule peut avoir plusieurs conducteurs 1:N
    - un conducteur peut avoir plusieurs véhicules 1:N
    -donc une relation N:N existe entre les deux 
 -->




<?php $content = ob_get_clean(); ?>

<?php view('template', compact('content')); ?>