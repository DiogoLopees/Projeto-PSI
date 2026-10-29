<?php

use yii\db\Migration;

class m261029_194551_create_hospitais extends Migration
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

        $this->createTable('{{%hospitais}}', [
            'idhospitais' => $this->primaryKey(),
            'nome' => $this->string(150)->notNull(),
            'morada' => $this->string(255)->notNull(),
            'telefone' => $this->string(20)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hospitais}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261029_194551_create_hospitais cannot be reverted.\n";

        return false;
    }
    */
}
