<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DadosDumpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dados Dumps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dados-dump-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dados Dump', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'campo1',
            'aluno_id',
            'campo3',
            'campo4',
            // 'campo5',
            // 'campo6',
            // 'campo7',
            // 'campo8',
            // 'campo9',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
