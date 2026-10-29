<?php

use yii\db\Migration;

class m261029_195658_create_sessao_materiais extends Migration
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

        $this->createTable('{{%sessao_materiais}}', [
            'idsessao' => $this->integer()->notNull(),
            'idmaterial' => $this->integer()->notNull(),
            'quantidade' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-sessao_materiais', '{{%sessao_materiais}}', ['idsessao', 'idmaterial']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sessao_materiais}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261029_195658_create_sessao_materiais cannot be reverted.\n";

        return false;
    }
    */
}
