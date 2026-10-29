<?php

use yii\db\Migration;

class m261029_195219_create_responsaveis extends Migration
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

        $this->createTable('{{%responsaveis}}', [
            'idresponsavel' => $this->primaryKey(),
            'idutilizador' => $this->integer()->notNull(),
            'idhospitais' => $this->integer()->notNull(),
            'cargo' => $this->string(100)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%responsaveis}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261029_195219_create_responsaveis cannot be reverted.\n";

        return false;
    }
    */
}
