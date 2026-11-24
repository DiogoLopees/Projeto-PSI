<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Criar uma nova conta';
$this->params['breadcrumbs'][] = $this->title;
$this->params['meta_description'] = 'Crie uma nova conta para começar.';
$this->params['meta_keywords'] = 'yii, yii2, signup, register, create account';

$htmlIcon = <<<HTML
{label}<div class="input-group"><span class="input-group-text bg-light text-primary" aria-hidden="true">%s</span>{input}</div>{error}{hint}
HTML;
$labelOptions = ['class' => 'form-label fw-semibold small'];
?>

<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-lg-10 col-xl-9">

            <!-- Botão para voltar ao site -->
            <div class="mb-3">
                <a href="<?= Url::to(['/site/index']) ?>" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i>Voltar ao Início
                </a>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="row g-0">

                    <!-- Brand panel -->
                    <div class="col-md-5 d-none d-md-flex bg-primary text-white">
                        <div class="d-flex flex-column justify-content-between p-4 p-lg-5 w-100">
                            <div>
                                <h3 class="text-white fw-bold m-0">
                                    <i class="fas fa-star-of-life me-2"></i>Terapia
                                </h3>
                            </div>
                            <div>
                                <h2 class="fw-bold text-white mb-3">
                                    Registe-se<br>aqui
                                </h2>
                                <p class="text-white opacity-75 mb-0">
                                    Crie a sua conta para marcar as suas consultas no Centro de Fisioterapia.
                                </p>
                            </div>
                            <div class="small text-white opacity-75">
                                &copy; <?= date('Y') ?> Terapia - Fisioterapia
                            </div>
                        </div>
                    </div>

                    <!-- Form panel -->
                    <div class="col-md-7 bg-white">
                        <div class="p-4 p-lg-5">
                            <div class="text-center mb-4">
                                <!-- Mobile-only logo -->
                                <div class="d-md-none mb-3">
                                    <h3 class="text-primary fw-bold m-0">
                                        <i class="fas fa-star-of-life me-2"></i>Terapia
                                    </h3>
                                </div>
                                <h1 class="h3 fw-bold mb-1"><?= Html::encode($this->title) ?></h1>
                                <p class="text-muted small">Preencha os campos abaixo para começar</p>
                            </div>

                            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                            <div class="mb-3">
                                <?= $form->field($model, 'username', [
                                        'options' => ['class' => 'mb-0'],
                                        'template' => sprintf($htmlIcon, '&#128100;'),
                                        'inputOptions' => [
                                                'autofocus' => true,
                                                'class' => 'form-control py-2',
                                                'placeholder' => 'Nome de utilizador',
                                        ],
                                ])->textInput()->label('Nome de Utilizador', $labelOptions) ?>
                            </div>

                            <div class="mb-3">
                                <?= $form->field($model, 'email', [
                                        'options' => ['class' => 'mb-0'],
                                        'template' => sprintf($htmlIcon, '&#9993;'),
                                        'inputOptions' => [
                                                'class' => 'form-control py-2',
                                                'placeholder' => 'email@example.com',
                                        ],
                                ])->textInput()->label('O Seu Email', $labelOptions) ?>
                            </div>

                            <div class="mb-4">
                                <?= $form->field($model, 'password', [
                                        'options' => ['class' => 'mb-0'],
                                        'template' => sprintf($htmlIcon, '&#128274;'),
                                        'inputOptions' => [
                                                'class' => 'form-control py-2',
                                                'placeholder' => 'Password',
                                        ],
                                ])->passwordInput()->label('A Sua Password', $labelOptions) ?>
                            </div>

                            <div class="d-grid">
                                <?= Html::submitButton(
                                        'Registar',
                                        [
                                                'class' => 'btn btn-primary btn-lg rounded-pill text-white fw-semibold',
                                                'name' => 'signup-button',
                                        ],
                                ) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

                            <div class="text-muted text-center mt-4 small">
                                Já tem conta? <?= Html::a('Inicie sessão', ['site/login'], ['class' => 'text-primary fw-bold text-decoration-none']) ?>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>