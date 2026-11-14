<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            [
                'attribute' => 'perfilUtilizador.nome',
                'label' => 'Nome Completo',
            ],
            [
                'attribute' => 'perfilUtilizador.tipo',
                'label' => 'Tipo',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

</div>