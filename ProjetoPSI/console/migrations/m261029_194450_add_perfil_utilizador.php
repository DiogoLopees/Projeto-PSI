<?php

use yii\db\Migration;

class m261029_194450_add_perfil_utilizador extends Migration
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

        $this->createTable('{{%perfil_utilizador}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(), // Coluna preparada para a chave estrangeira
            'nome' => $this->string(150)->notNull(),
            'cargo' => $this->string(50)->notNull()->defaultValue('cliente'),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%perfil_utilizador}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261029_194450_add_perfil_utilizador cannot be reverted.\n";

        return false;
    }
    */
}
