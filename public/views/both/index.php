<?php ob_start(); ?>

<a href="<?= url('boths/add') ?>">Ajouter un élément</a>

<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>Vehicule</th>
        <th>Conducteur/trice</th>
        <th></th>
    </tr>

    <?php foreach($boths as $both) : ?>
        <tr>
            <td><?= $both->id() ?></td>
            <td><?= $both->vehicule()->nomComplet() ?></td>
            <td><?= $both->conducteur()->nomComplet() ?></td>
            <td>
                <a href="<?= url('boths/' . $both->id() . '/delete')?>" class="delete">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>