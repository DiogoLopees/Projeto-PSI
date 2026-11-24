<?php

declare(strict_types=1);

namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\mail\MailerInterface;
use common\models\PerfilUtilizador;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public string $username = '';
    public string $email = '';
    public string $password = '';
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'Este nome de utilizador já está a ser utilizado.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Este email já está a ser utilizado.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'username' => 'Nome de Utilizador',
        ];
    }

    /**
     * Signs user up.
     *
     * @param MailerInterface $mailer the mailer component.
     * @param string $supportEmail the support email address.
     * @param string $appName the application name.
     *
     * @return bool|null whether the creating new account was successful and email was sent.
     */
    public function signup(MailerInterface $mailer, string $supportEmail, string $appName): bool|null
    {
        if (!$this->validate()) {
            return null;
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();

            if (!$user->save()) {
                $transaction->rollBack();
                return null;
            }

            $perfil = new PerfilUtilizador();
            $perfil->id_user = $user->id;
            $perfil->nome = $this->username;
            $perfil->cargo = PerfilUtilizador::CARGO_CLIENTE;

            if (!$perfil->save()) {
                $transaction->rollBack();
                return null;
            }

            $transaction->commit();
            return $this->sendEmail($mailer, $user, $supportEmail, $appName);
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * Sends confirmation email to user.
     *
     * @param MailerInterface $mailer the mailer component.
     * @param User $user user model to which the email should be sent.
     * @param string $supportEmail the support email address.
     * @param string $appName the application name.
     *
     * @return bool whether the email was sent.
     */
    protected function sendEmail(MailerInterface $mailer, User $user, string $supportEmail, string $appName): bool
    {
        return $mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user],
            )
            ->setFrom([$supportEmail => $appName . ' robot'])
            ->setTo($this->email)
            ->setSubject('Registo de conta em ' . $appName)
            ->send();
    }
}
