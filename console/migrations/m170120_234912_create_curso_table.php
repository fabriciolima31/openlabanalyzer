<?php

use yii\db\Migration;

/**
 * Handles the creation of table `curso`.
 */
class m170120_234912_create_curso_table extends Migration
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
        
        $this->createTable('curso', [
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
        $this->dropTable('curso');
    }
}
