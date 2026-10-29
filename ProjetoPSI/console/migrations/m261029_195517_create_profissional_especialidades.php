<?php

use yii\db\Migration;

class m261029_195517_create_profissional_especialidades extends Migration
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

        $this->createTable('{{%profissional_especialidades}}', [
            'idprofissional' => $this->integer()->notNull(),
            'idespecialidade' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-profissional_especialidades', '{{%profissional_especialidades}}', ['idprofissional', 'idespecialidade']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profissional_especialidades}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261029_195517_create_profissional_especialidades cannot be reverted.\n";

        return false;
    }
    */
}
