<?php

use yii\db\Migration;

class m261029_195923_create_avaliacao_profissional extends Migration
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

        $this->createTable('{{%avaliacao_profissional}}', [
            'idevolucao' => $this->primaryKey(),
            'idsessao' => $this->integer()->notNull(),
            'notas' => $this->text()->null(),
            'avaliacao' => $this->integer()->notNull(),
            'dataregisto' => $this->dateTime()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%avaliacao_profissional}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261029_195923_create_avaliacao_profissional cannot be reverted.\n";

        return false;
    }
    */
}
