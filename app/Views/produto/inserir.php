<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <p class="text-center mb-5 fs-3">Cadastro de produtos</p>

    <div class="row">
        <div class="col-4 offset-4">

            <form method="post">
                <?= csrf_field() ?>

                <div class="form-group">

                    <label for="nomecat" class="form-label">Descrição do produto</label>
                    <input type="text" class="form-control" id="nomecat" name="descproduto" value="<?= (isset($produto) ? $produto->descproduto : '') ?>" placeholder="Informe a descrição do produto" require />

                    <div class="mt-3">
                        <label for="preco" class="form-label">Valor do produto</label>
                        R$ <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?= (isset($produto) ? $produto->preco : '') ?>" require />
                    </div>

                    <!--
                        <div class="mt-3">
                            <label for="nomecat" class="form-label">Categoria do produto</label>
                            <div><= $idcategoria ?></div>
                        </div>-->

                    <div class="mt-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select id="categoria" name="idcategoria" class="form-select" aria-label="Default select example">
                            <option value="0">Selecione...</option>

                            <?php foreach ($categorias as $categoria) : ?>
                                <?php
                                if (isset($produto)) {
                                    if ($produto->idcategoria === $categoria->id) { ?>
                                        <option selected value="<?= $categoria->id ?>"><?= $categoria->nomecategoria ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $categoria->id ?>"><?= $categoria->nomecategoria ?></option>
                                    <?php }
                                } else { ?>
                                    <option value="<?= $categoria->id ?>"><?= $categoria->nomecategoria ?></option>
                                <?php } ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="<?= (isset($produto) ? $produto->id : '') ?>" />

                </div>

                <div class="row mt-5">
                    <div class="col">
                        <a href="<?= base_url('/produtos') ?>" class="btn btn-secondary btn-sm">Cancelar</a>
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