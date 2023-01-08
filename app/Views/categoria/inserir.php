<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <p class="text-center mb-5 fs-3">Cadastro de categoria</p>

    <div class="row">
        <div class="col-4 offset-4">

            <form method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <div class="mb-3">
                        <label for="nomecat" class="form-label">Descrição da categoria</label>
                        <input type="text" class="form-control" id="nomecat" name="nomecategoria" value="<?= (isset($categoria) ? $categoria->nomecategoria : '') ?>" placeholder="Informe a descrição da categoria" require />

                        <input type="hidden" name="id" value="<?= (isset($categoria) ? $categoria->id : '') ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <a href="<?= base_url('/categorias') ?>" class="btn btn-secondary btn-sm">Cancelar</a>
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