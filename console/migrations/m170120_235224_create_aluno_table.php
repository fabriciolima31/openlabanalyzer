<?php

use yii\db\Migration;

/**
 * Handles the creation of table `aluno`.
 */
class m170120_235224_create_aluno_table extends Migration
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

        $this->createTable('aluno', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(50)->notNull(),
            'turma_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `aluno_id`
        $this->createIndex(
            'idx-aluno-turma_id',
            'aluno',
            'turma_id'
        );

        // add foreign key for table `turma`
        $this->addForeignKey(
            'fk-aluno-turma_id',
            'aluno',
            'turma_id',
            'turma',
            'id',
            'RESTRICT'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        
        // drops foreign key for table `aluno`
        $this->dropForeignKey(
            'fk-aluno-turma_id',
            'aluno'
        );

        // drops index for column `aluno_id`
        $this->dropIndex(
            'idx-aluno-turma_id',
            'aluno'
        );
        
        $this->dropTable('aluno');
    }
}
