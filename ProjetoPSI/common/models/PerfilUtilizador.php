<?php

declare(strict_types=1);

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class PerfilUtilizador extends ActiveRecord
{
    public const CARGO_CLIENTE = 'cliente';
    public const CARGO_ADMIN = 'admin';
    public const CARGO_TERAPEUTA = 'terapeuta';

    public static function tableName(): string
    {
        return '{{%perfil_utilizador}}';
    }

    public function rules(): array
    {
        return [
            [['id_user', 'nome'], 'required'],
            ['id_user', 'integer'],
            ['id_user', 'unique'],
            ['nome', 'string', 'max' => 150],
            ['cargo', 'string', 'max' => 50],
            ['cargo', 'default', 'value' => self::CARGO_CLIENTE],
            ['cargo', 'in', 'range' => [self::CARGO_CLIENTE, self::CARGO_ADMIN, self::CARGO_TERAPEUTA]],
            ['id_user', 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID Perfil',
            'id_user' => 'ID Utilizador',
            'nome' => 'Nome Completo',
            'cargo' => 'Cargo',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}