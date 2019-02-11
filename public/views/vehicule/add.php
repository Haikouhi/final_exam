<?php ob_start(); ?>

<a href="<?= url('vehicules') ?>">Retour</a>

<form action="<?= url('vehicules/save') ?>" method="post">

    <input type="hidden"    name="id"                   value="<?= (isset($vehicule)) ? $vehicule->id() : '' ?>">
    <input type="text"      name="marque"               value="<?= (isset($vehicule)) ? $vehicule->marque() : '' ?>"            placeholder="Marque"            class="form-control">
    <input type="text"      name="modele"               value="<?= (isset($vehicule)) ? $vehicule->modele() : '' ?>"            placeholder="Modèle"            class="form-control">
    <input type="text"      name="couleur"              value="<?= (isset($vehicule)) ? $vehicule->couleur() : '' ?>"           placeholder="Couleur"           class="form-control">
    <input type="text"      name="immatriculation"      value="<?= (isset($vehicule)) ? $vehicule->immatriculation() : '' ?>"   placeholder="Immatriculation"   class="form-control">

    <button type="submit" class="btn btn-<?= (isset($conducteur)) ? 'warning' : 'success' ?>">
        <?= (isset($conducteur)) ? 'Editer' : 'Créer' ?> un vehicule
    </button>
</form>

<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>