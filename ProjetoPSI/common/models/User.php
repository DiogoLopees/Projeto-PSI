<?php

declare(strict_types=1);

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public const STATUS_DELETED = 0;
    public const STATUS_INACTIVE = 9;
    public const STATUS_ACTIVE = 10;

    public $new_password;

    public static function tableName(): string
    {
        return '{{%user}}';
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules(): array
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            ['new_password', 'string', 'min' => 6],
            [['username', 'email'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            [['username', 'email'], 'unique'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'username' => 'Nome de Utilizador',
            'email' => 'Email',
            'status' => 'Estado',
            'new_password' => 'Nova Password',
        ];
    }

    /**
     * Relação 1 para 1 com a tabela perfil_utilizador
     */
    public function getPerfilUtilizador()
    {
        return $this->hasOne(PerfilUtilizador::class, ['id_user' => 'id']);
    }

    public static function findIdentity($id): User|null
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null): never
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername(string $username): User|null
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByPasswordResetToken(string $token): User|null
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function findByVerificationToken(string $token): User|null
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE,
        ]);
    }

    public static function isPasswordResetTokenValid(string|null $token): bool
    {
        if ($token === null || $token === '') {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];

        return $timestamp + $expire >= time();
    }

    public function getId(): int
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword(string $password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey(): void
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken(): void
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateEmailVerificationToken(): void
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken(): void
    {
        $this->password_reset_token = null;
    }
}