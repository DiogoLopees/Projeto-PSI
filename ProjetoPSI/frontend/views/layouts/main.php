<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>

        <!-- Google Web Fonts (Necessário para a tipografia igual ao template) -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet (Para os ícones de telefone, redes sociais, setas, etc.) -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet (Animações e Carrossel da pasta lib) -->
        <link href="<?= Url::to('@web/template/lib/animate/animate.min.css') ?>" rel="stylesheet">
        <link href="<?= Url::to('@web/template/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet & Template Stylesheet -->
        <link href="<?= Url::to('@web/template/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?= Url::to('@web/template/css/style.css') ?>" rel="stylesheet">

        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <?= Alert::widget() ?>
    <?= $content ?>

    <!-- JavaScript Libraries (Essenciais para o carrossel e animações funcionarem) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= Url::to('@web/template/lib/wow/wow.min.js') ?>"></script>
    <script src="<?= Url::to('@web/template/lib/easing/easing.min.js') ?>"></script>
    <script src="<?= Url::to('@web/template/lib/waypoints/waypoints.min.js') ?>"></script>
    <script src="<?= Url::to('@web/template/lib/owlcarousel/owl.carousel.min.js') ?>"></script>

    <!-- Template Javascript -->
    <script src="<?= Url::to('@web/template/js/main.js') ?>"></script>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>