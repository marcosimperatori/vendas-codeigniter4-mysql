<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <p class="text-center mb-5 fs-3">Cadastro de cliente</p>

    <div class="row">
        <div class="col-4 offset-4">

            <form method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <div class="mb-3">
                        <label for="nomecat" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nomecat" name="nome" value="<?= (isset($cliente) ? $cliente->nome : '') ?>" placeholder="Informe o nome do cliente" require />

                        <div class="mt-2">
                            <label for="calendario" class="form-label">Data de nascimento</label>
                            <input type="date" class="form-control w-50" id="calendario" name="nascimento" value="<?= (isset($cliente) ? $cliente->nascimento : '') ?>" require />
                        </div>

                        <input type="hidden" name="id" value="<?= (isset($cliente) ? $cliente->id : '') ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <a href="<?= base_url('/clientes') ?>" class="btn btn-secondary btn-sm">Cancelar</a>
                    </div>
                    <div class="col text-end">
                        <input type="submit" value="<?= $acao ?>" class="btn btn-primary btn-sm">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>