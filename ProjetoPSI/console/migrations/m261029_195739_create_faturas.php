<?php

use yii\db\Migration;

class m261029_195739_create_faturas extends Migration
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

        $this->createTable('{{%faturas}}', [
            'idfatura' => $this->primaryKey(),
            'idutente' => $this->integer()->notNull(),
            'datafatura' => $this->dateTime()->notNull(),
            'valortotal' => $this->decimal(10, 2)->notNull(),
            'estado' => $this->string(50)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%faturas}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261029_195739_create_faturas cannot be reverted.\n";

        return false;
    }
    */
}
