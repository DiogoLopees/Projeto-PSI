<?php

use yii\db\Migration;

class m261029_195827_create_linhasfatura extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%linhasfatura}}', [
            'idlinha' => $this->primaryKey(),
            'idfatura' => $this->integer()->notNull(),
            'idsessao' => $this->integer()->notNull(),
            'descricao' => $this->string(255)->notNull(),
            'quantidade' => $this->integer()->notNull(),
            'precounitario' => $this->decimal(7, 2)->notNull(),
            'nome_materiais' => $this->string(500)->null(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%linhasfatura}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261029_195827_create_linhasfatura cannot be reverted.\n";

        return false;
    }
    */
}
