<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Sobre';
$this->params['breadcrumbs'][] = $this->title;
$this->params['meta_description'] = 'Saiba mais sobre a nossa aplicação e a equipa por detrás dela.';
$this->params['meta_keywords'] = 'yii, yii2, about, php, framework';
?>
<div class="site-about d-flex align-items-center justify-content-center text-center">
    <div class="site-about-content mx-auto">
        <h1 class="display-6 fw-semibold mb-3"><?= Html::encode($this->title) ?></h1>

        <p class="text-body-secondary mb-4">
            Esta é a página Sobre. Pode modificar o seguinte ficheiro para personalizar o seu conteúdo:
            <?php if (YII_DEBUG): ?>
                <code class="d-block mt-2"><?= __FILE__ ?></code>
            <?php endif; ?>
        </p>

        <?= Html::a(
            'Ir para a Página Inicial',
            Yii::$app->homeUrl,
            [
                'class' => 'btn btn-outline-primary btn-lg',
            ],
        ) ?>
    </div>
</div>
