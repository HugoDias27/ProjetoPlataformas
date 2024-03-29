<?php
$this->title = 'Carolo Farmacêutica';
$this->params['breadcrumbs'] = [['label' => $this->title]];
$logo = '../web/img/logo.png';
?>
<div class="container-fluid">
    <!--- <div class="row">
        <div class="col-lg-6">

        </div>
    </div> -->

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Gastos',
                'number' => $totalGastos,
                'icon' => 'fas fa-euro-sign',
            ]) ?>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Compras do Último Mês',
                'number' => $n_compras,
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total Ganho no Último Mês',
                'number' => $totalGanho,
                'icon' => 'fas fa-euro-sign',
            ]) ?>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Líder de Vendas do Último Mês',
                'number' => $estabelecimentoMaisVendas,
                'icon' => 'fas fa-store',
            ]) ?>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Produto Mais vendido',
                'number' => $produtoMaisVendido,
                'icon' => 'fas fa-box',
            ]) ?>
        </div>
    </div>

    <hr>
    <h1 align="center">Carolo Farmacêutica</h1>
    <div class="row">
        <div id="DataAtual" class="col-md-4 col-sm-6 col-12">
            <script src="..\web\js\scriptData.js"></script>
        </div>

        <div id="horaAtual" class="col-md-4 col-sm-6 col-12">
            <script src="..\web\js\scriptHora.js"></script>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <img src="<?php echo $logo; ?>" width="300pd">
        </div>
    </div>
    <br>
    <hr>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12" align="center">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Bem-Vindo(a)!'
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12" align="center">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Backoffice - Gestão do Sistema'
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12" align="center">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Carolo Farmacêutica'
            ]) ?>
        </div>
    </div>
</div>