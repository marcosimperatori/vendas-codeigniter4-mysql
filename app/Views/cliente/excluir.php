<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <p class="text-center mb-5 fs-5"> <?= $titulo ?></p>

    <div class="row">
        <div class="col-4 offset-4">

            <form method="post">
                <?= csrf_field() ?>

                <div class="text-center">
                    <p class="fs-5">Confirma a exclusão do cliente a seguir?</p>
                    <p class="fs-2"><?= (isset($cliente) ? $cliente->nome : '') ?></p>
                    <input type="hidden" value="<?= (isset($cliente) ? $cliente->id : '') ?>" />
                </div>

                <div class="row mt-5">
                    <div class="col">
                        <a href=" <?= base_url('/clientes') ?>" class="text-primary">Cancelar</a>
                    </div>
                    <div class="col text-end">
                        <input type="submit" value="<?= $acao ?>" class="btn btn-danger btn-sm">
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection() ?>