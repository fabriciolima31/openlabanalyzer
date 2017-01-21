<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dadosdump`.
 */
class m170120_235254_create_dadosDump_table extends Migration
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

        $this->createTable('dadosDump', [
            'id' => $this->primaryKey(),
            'campo1' => $this->string(200),
            'campo2' => $this->string(200),
            'campo3' => $this->string(200),
            'campo4' => $this->string(200),
            'campo5' => $this->string(200),
            'campo6' => $this->string(200),
            'campo7' => $this->string(200),
            'campo8' => $this->string(200),
            'campo9' => $this->string(200),
            'aluno_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `aluno_id`
        $this->createIndex(
            'idx-dadosDump-aluno_id',
            'dadosDump',
            'aluno_id'
        );

        // add foreign key for table `aluno`
        $this->addForeignKey(
            'fk-dadosDump-aluno_id',
            'dadosDump',
            'aluno_id',
            'aluno',
            'id',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
         // drops foreign key for table `dadosDump`
        $this->dropForeignKey(
            'fk-dadosDump-aluno_id',
            'dadosDump'
        );

        // drops index for column `aluno_id`
        $this->dropIndex(
            'idx-dadosDump-aluno_id',
            'dadosDump'
        );

        $this->dropTable('dadosdump');
    }
}
