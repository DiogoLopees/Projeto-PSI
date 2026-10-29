<?php

use yii\db\Migration;

class m261029_195400_create_disponibilidades extends Migration
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

        $this->createTable('{{%disponibilidades}}', [
            'iddisponibilidade' => $this->primaryKey(),
            'idprofissional' => $this->integer()->notNull(),
            'diadasemana' => $this->string(20)->notNull(),
            'horainicio' => $this->time()->notNull(),
            'horafim' => $this->time()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%disponibilidades}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261029_195400_create_disponibilidades cannot be reverted.\n";

        return false;
    }
    */
}
