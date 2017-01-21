<?php

use yii\db\Migration;

/**
 * Handles the creation of table `turma`.
 */
class m170120_235214_create_turma_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('turma', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(50)->notNull(),
            'descricao' => $this->string(200),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('turma');
    }
}
