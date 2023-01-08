<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row mt-5">
        <div class="col-sm-3">
            <div class="card mt-3">

                <div class="card-body">
                    <h5 class="cart-title">
                        Categorias
                        <span class="badge rounded-pill bg-success">
                            <?= $categoria ?>
                        </span>
                    </h5>
                    <p class="card-text">
                        Gerencie as categorias
                    </p>
                    <div class="text-end">
                        <a href="<?= base_url('/categorias') ?>">Acessar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="cart-title">
                        Produtos
                        <span class="badge rounded-pill bg-primary">
                            <?= $produto ?>
                        </span>
                    </h5>
                    <p class="card-text">
                        Gerencie seus produtos
                    </p>
                    <div class="text-end">
                        <a href="<?= base_url('/produtos') ?>">Acessar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="cart-title">
                        Clientes
                        <span class="badge rounded-pill bg-danger">
                            <?= $cliente ?>
                        </span>
                    </h5>
                    <p class="card-text">
                        Gerencie seus clientes
                    </p>
                    <div class="text-end">
                        <a href="<?= base_url('/clientes') ?>">Acessar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="cart-title">
                        Vendas
                        <span class="badge rounded-pill bg-secondary">
                            <?= $venda ?>
                        </span>
                    </h5>
                    <p class="card-text">
                        Gerencie suas vendas
                    </p>
                    <div class="text-end">
                        <a href="<?= base_url('/vendas') ?>">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Data', 'Quantidade'],

                <?php foreach ($grafico as $item) : ?>['<?= $item->data ?>', <?= $item->total ?>],
                <?php endforeach; ?>

            ]);
            var options = {
                title: 'Quantidade de produtos vendidos por dia',
                legend: {
                    position: 'none'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
            var chart2 = new google.visualization.ColumnChart(document.getElementById('curve_chart2'));
            var chart3 = new google.visualization.BarChart(document.getElementById('curve_chart3'));

            chart.draw(data, options);
            chart2.draw(data, options);
            chart3.draw(data, options);
        }
    </script>

    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div id="curve_chart" style="width: 900px; height: 500px" class="w-100"></div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-7">
            <div>
                <div id="curve_chart2" style="width: 900px; height: 500px" class="w-100"></div>
            </div>
        </div>
        <div class="col-5">
            <div>
                <div id="curve_chart3" style="width: 900px; height: 500px" class="w-100"></div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>