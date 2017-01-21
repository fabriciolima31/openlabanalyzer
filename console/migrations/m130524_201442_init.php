<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'nome' => $this->string(100)->notNull(),
            'cpf' => $this->string(14)->notNull(),
            'administrador' => $this->char(1)->defaultValue(NULL),
            'professor' => $this->char(1)->defaultValue(NULL),
            'aluno' => $this->char(1)->defaultValue(NULL),

        ], $tableOptions);

        $this->insert('{{%user}}', [
            'id' => '1',
            'username' => 'malb',
            'auth_key' => 'ZfEWJOn178KU6qBqhaNyVOnpqnBcl8Za',
            'password_hash' => '$2y$13$caoX9kEiGzE6FoON9dx4D.WmzxpUmNr.fAvLhmIDRNwBaovSMMH..',
            'password_reset_token' => NULL,
            'email' => 'malb@icomp.ufam.edu.br',
            'status' => 10,
            'created_at' => 1482113966,
            'updated_at' => 1482113966,
            'nome' => 'Marcelo',
            'cpf' => '123456',
            'administrador' => NULL,
            'professor' => NULL,
            'aluno' => NULL,
        ]);

        $this->insert('{{%user}}', [
            'id' => '2',
            'username' => 'fabricio',
            'auth_key' => 'J-crr4L1WNNteLgGMayjJ34ifMG3FURy',
            'password_hash' => '$2y$13$6Ez9RJ1Y4sjLri5zq4Onve/Ktr3SIIm5dxaTUOWFD3YujoYnT89t.',
            'password_reset_token' => NULL,
            'email' => 'fabriciolima31@gmail.com',
            'status' => 10,
            'created_at' => 1484759916,
            'updated_at' => 1484759916,
            'nome' => 'Fabrício Lima',
            'cpf' => '123456',
            'administrador' => NULL,
            'professor' => NULL,
            'aluno' => NULL,
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
