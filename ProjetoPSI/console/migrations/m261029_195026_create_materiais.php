<?php

use yii\db\Migration;

class m261029_195026_create_materiais extends Migration
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

        $this->createTable('{{%materiais}}', [
            'idmaterial' => $this->primaryKey(),
            'nome' => $this->string(150)->notNull(),
            'descricao' => $this->text()->null(),
            'custounitario' => $this->decimal(7, 2)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%materiais}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261029_195026_create_materiais cannot be reverted.\n";

        return false;
    }
    */
}
