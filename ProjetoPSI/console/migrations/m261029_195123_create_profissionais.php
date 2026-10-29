<?php

use yii\db\Migration;

class m261029_195123_create_profissionais extends Migration
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

        $this->createTable('{{%profissionais}}', [
            'idprofissional' => $this->primaryKey(),
            'idutilizador' => $this->integer()->notNull(),
            'idhospitais' => $this->integer()->notNull(),
            'cedulaprofissional' => $this->string(50)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profissionais}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261029_195123_create_profissionais cannot be reverted.\n";

        return false;
    }
    */
}
