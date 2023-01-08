<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <div class="row mt-5">
        <div class="col">
            <p class="fs-4">
                Listagem de vendas
            </p>
        </div>
        <div class="col text-end">
            <a href="<?= base_url('/vendas/inserir') ?>" class="btn btn-primary btn-sm">Lançar venda</a>
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
                <th>Data</th>
                <th>Cliente</th>
                <th class="text-end">Valor</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendas as $venda) : ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($venda->datacompra)) ?></td>
                    <td><?= $venda->nome ?></td>
                    <td class="text-end"><?= 'R$ ' . $venda->valorunitario ?></td>
                    <td class="text-center">
                        <a class="text-primary" href="<?= base_url('vendas/editar/' . $venda->id) ?>">Editar</a>
                        <a class="text-danger" href="<?= base_url('vendas/excluir/' . $venda->id) ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>