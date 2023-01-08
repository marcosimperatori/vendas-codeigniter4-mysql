<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <div class="row mt-5">
        <div class="col">
            <p class="fs-4">
                Listagem de produtos
            </p>
        </div>
        <div class="col text-end">
            <a href="<?= base_url('/produtos/inserir') ?>" class="btn btn-primary btn-sm">Inserir produto</a>
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
            <?php foreach ($produtos as $produto) : ?>
                <tr>
                    <td><?= $produto->descproduto ?></td>
                    <td class="text-center">
                        <a class="text-primary" href="<?= base_url('produtos/editar/' . $produto->id) ?>">Editar</a>
                        <a class="text-danger" href="<?= base_url('produtos/excluir/' . $produto->id) ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>