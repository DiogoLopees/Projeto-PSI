<?php

use yii\db\Migration;

class m261029_194924_create_salasequipamentos extends Migration
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

        $this->createTable('{{%salasequipamentos}}', [
            'idsala' => $this->primaryKey(),
            'idhospitais' => $this->integer()->notNull(),
            'designacao' => $this->string(100)->notNull(),
            'tipo' => $this->string(100)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%salasequipamentos}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261029_194924_create_salasequipamentos cannot be reverted.\n";

        return false;
    }
    */
}
