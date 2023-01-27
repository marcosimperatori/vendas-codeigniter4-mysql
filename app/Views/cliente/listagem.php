<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <div class="row mt-5">
        <div class="col">
            <p class="fs-4">
                Listagem de clientes
            </p>
        </div>
        <div class="col text-end">
            <a href="<?= base_url('/clientes/inserir') ?>" class="btn btn-primary btn-sm">Inserir cliente</a>
        </div>
    </div>

    <?php if ((!is_null($msg)) or (!empty($msg))) : ?>
        <div class="alert <?= $estilo ?>">
            <?= $msg ?>
        </div>
    <?php endif; ?>

    <table class="table table-sm table-striped mt-2">
        <thead>
            <tr class="bg-dark text-white">
                <th>Descrição</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente) : ?>
                <tr>
                    <td><?= $cliente->nome ?></td>
                    <td class="text-center">
                        <a class="text-primary" href="<?= base_url('clientes/editar/' . $cliente->id) ?>">Editar</a>
                        <a class="text-danger" href="<?= base_url('clientes/excluir/' . $cliente->id) ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>