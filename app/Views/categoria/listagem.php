<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <div class="row mt-5">
        <div class="col">
            <p class="fs-4">
                Listagem de categorias
            </p>
        </div>
        <div class="col text-end">
            <a href="<?= base_url('/categorias/inserir') ?>" class="btn btn-primary btn-sm">Inserir categoria</a>
        </div>
    </div>

    <?php if ((!is_null($msg)) or (!empty($msg))) : ?>
        <div class="alert <?= $estilo ?>">
            <?= $msg ?>
        </div>
    <?php endif; ?>

    <table class="table table-sm table-striped">
        <thead>
            <tr class="bg-dark text-white">
                <th>Descrição</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria) : ?>
                <tr>
                    <td><?= $categoria->nomecategoria ?></td>
                    <td class="text-center">
                        <a class="text-primary" href="<?= base_url('categorias/editar/' . $categoria->id) ?>">Editar</a>
                        <a class="text-danger" href="<?= base_url('categorias/excluir/' . $categoria->id) ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>