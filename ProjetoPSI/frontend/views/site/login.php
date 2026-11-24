<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Inicie sessão na sua conta';
$this->params['breadcrumbs'][] = $this->title;
$this->params['meta_description'] = 'Inicie sessão para aceder à sua conta.';
$this->params['meta_keywords'] = 'yii, yii2, login, sign in, authentication';

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
                                    Bem-vindo<br>de Volta
                                </h2>
                                <p class="text-white opacity-75 mb-0">
                                    Inicie sessão para aceder à aplicação e gerir a sua conta.
                                </p>
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
                                <p class="text-body-secondary small">Introduza as suas credenciais para continuar</p>
                            </div>

                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                            <div class="mb-3">
                                <?= $form->field($model, 'username', [
                                        'options' => ['class' => 'mb-0'],
                                        'template' => sprintf($htmlIcon, '&#128100;'),
                                        'inputOptions' => [
                                                'class' => 'form-control py-2',
                                                'placeholder' => 'nome de utilizador',
                                                'autofocus' => true,
                                        ],
                                ])->textInput()->label('Nome de Utilizador', $labelOptions) ?>
                            </div>

                            <div class="mb-3">
                                <?= $form->field($model, 'password', [
                                        'options' => ['class' => 'mb-0'],
                                        'template' => sprintf($htmlIcon, '&#128274;'),
                                        'inputOptions' => [
                                                'class' => 'form-control py-2',
                                                'placeholder' => 'Password',
                                        ],
                                ])->passwordInput()->label('A Sua Password', $labelOptions) ?>
                            </div>

                            <div class="mb-4">
                                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                            </div>

                            <div class="d-grid">
                                <?= Html::submitButton(
                                        'Login',
                                        [
                                                'class' => 'btn btn-primary btn-lg rounded-pill text-white',
                                                'name' => 'login-button',
                                        ],
                                ) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

                            <div class="text-body-secondary text-center mt-3 small">
                                <?= Html::a('Esqueceu-se da password?', ['site/request-password-reset']) ?>
                                <span class="mx-1">&middot;</span>
                                <?= Html::a('Reenviar email de verificação', ['site/resend-verification-email']) ?>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>