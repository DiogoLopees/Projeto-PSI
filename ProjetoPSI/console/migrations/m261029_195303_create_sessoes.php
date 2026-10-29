<?php

use yii\db\Migration;

class m261029_195303_create_sessoes extends Migration
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

        $this->createTable('{{%sessoes}}', [
            'idsessao' => $this->primaryKey(),
            'idutente' => $this->integer()->notNull(),
            'idprofissional' => $this->integer()->notNull(),
            'idespecialidade' => $this->integer()->notNull(),
            'idsala' => $this->integer()->notNull(),
            'datashora' => $this->dateTime()->notNull(),
            'estado' => $this->string(50)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sessoes}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261029_195303_create_sessoes cannot be reverted.\n";

        return false;
    }
    */
}
