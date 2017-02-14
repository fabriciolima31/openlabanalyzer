<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aluno".
 *
 * @property integer $id
 * @property string $nome
 * @property integer $turma_id
 *
 * @property Turma $turma
 * @property DadosDump[] $dadosDumps
 */
class Aluno extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aluno';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'turma_id'], 'required'],
            [['turma_id'], 'integer'],
            [['nome'], 'string', 'max' => 50],
            [['turma_id'], 'exist', 'skipOnError' => true, 'targetClass' => Turma::className(), 'targetAttribute' => ['turma_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'turma_id' => 'Turma ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTurma()
    {
        return $this->hasOne(Turma::className(), ['id' => 'turma_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDadosDumps()
    {
        return $this->hasMany(DadosDump::className(), ['aluno_id' => 'id']);
    }
}
