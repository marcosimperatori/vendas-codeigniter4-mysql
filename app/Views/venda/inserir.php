<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <div class="row">

        <div class="col-4 offset-4">
            <div class="text-center">
                <p class="fs-4">Dados da compra</p>
            </div>

            <form method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="cli" class="form-label">Selecione o cliente</label>
                    <select id="categoria" name="idcliente" class="form-select" aria-label="Default select example">
                        <option value="0">Selecione...</option>

                        <?php foreach ($clientes as $cliente) : ?>
                            <?php
                            if (isset($venda)) {
                                if ($venda->idcliente === $cliente->id) { ?>
                                    <option selected value="<?= $cliente->id ?>"><?= $cliente->nome ?></option>
                                <?php } else { ?>
                                    <option value="<?= $cliente->id ?>"><?= $cliente->nome ?></option>
                                <?php }
                            } else { ?>
                                <option value="<?= $cliente->id ?>"><?= $cliente->nome ?></option>
                            <?php } ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cli" class="form-label">Selecione o produto</label>
                    <select id="categoria" name="idproduto" class="form-select" aria-label="Default select example">
                        <option value="0">Selecione...</option>

                        <?php foreach ($produtos as $produto) : ?>
                            <?php
                            if (isset($venda)) {
                                if ($venda->idproduto === $produto->id) { ?>
                                    <option selected value="<?= $produto->id ?>"><?= $produto->descproduto ?></option>
                                <?php } else { ?>
                                    <option value="<?= $produto->id ?>"><?= $produto->descproduto ?></option>
                                <?php }
                            } else { ?>
                                <option value="<?= $produto->id ?>"><?= $produto->descproduto ?></option>
                            <?php } ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="qtde" class="form-label">Quantidade</label>
                            <input type="value" class="form-control w-100" id="qtde" name="qtde" value="<?= (isset($venda) ? $venda->qtde : '') ?>">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3 flex justify-content-end">
                            <label for="qtde" class="form-label">Valor</label>
                            <input type="number" class="form-control w-75" id="qtde" name="valorunitario" value="<?= (isset($venda) ? $venda->valorunitario : '') ?>">
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="mb-3">
                            <label for="calendario" class="form-label">Data</label>
                            <input type="date" class="form-control" id="calendario" name="datacompra" value="<?= (isset($venda) ? $venda->datacompra : '') ?>" require />
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?= (isset($venda) ? $venda->id : '') ?>" />

                <div class="row mt-5">
                    <div class="col">
                        <a href="<?= base_url('/vendas') ?>" class="btn btn-secondary btn-sm">Cancelar</a>
                    </div>
                    <div class="col text-end">
                        <input type="submit" value="<?= $acao ?>" class="btn btn-success btn-sm">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<?= $this->endSection() ?>