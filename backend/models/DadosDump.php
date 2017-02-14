<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dadosDump".
 *
 * @property integer $id
 * @property string $campo1
 * @property string $campo2
 * @property string $campo3
 * @property string $campo4
 * @property string $campo5
 * @property string $campo6
 * @property string $campo7
 * @property string $campo8
 * @property string $campo9
 * @property integer $aluno_id
 * @property file $csvFiles
 *
 * @property Aluno $aluno
 */
class DadosDump extends \yii\db\ActiveRecord
{
    public $fileCSVName = array();
    public $csvFiles;
    public $QteCsvSaves=0;
    public $dadosDump;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dadosDump';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aluno_id'], 'integer'],
            [['campo1', 'campo3', 'campo4', 'campo5', 'campo6', 'campo7', 'campo8', 'campo9'], 'string', 'max' => 200],
            [['csvFiles'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'csvFiles' => 'Dumps',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(Aluno::className(), ['id' => 'aluno_id']);
    }

    public function beforeSave($insert)
    {
        /*DadosDump::deleteAll('campo1 = :campo1 AND aluno_id = :aluno_id', [':campo1' => $this->campo1, ':aluno_id' => $this->aluno_id]);*/

        $aluno = new Aluno();
        if (Aluno::find()->where( ['id' => $this->aluno_id] )->count() == 0) {
            $aluno->id = $this->aluno_id;
            $aluno->nome = "-";
            $aluno->turma_id = 1;
            if(!$aluno->save())
                return false;
        }
        
        return true;
    }


    public function editSave()
    {
        if ($this->validate()) {
            foreach ($this->csvFiles as $file) {
                $this->fileCSVName = microtime(). '.' . $file->extension;
                $file->saveAs('CSV/' . $this->fileCSVName);

                if (($handle = fopen('CSV/'.$this->fileCSVName, "r")) !== FALSE) {
                    while (($dado = fgets($handle)) !== FALSE) {
                        $dado = explode(';', $dado);
                        $this->dadosDump = new DadosDump();    
                        $this->dadosDump->campo1 = $dado[0];
                        $this->dadosDump->aluno_id = $dado[1];
                        $this->dadosDump->campo3 = $dado[2];
                        $this->dadosDump->campo4 = $dado[3];
                        $this->dadosDump->campo5 = $dado[4];
                        $this->dadosDump->campo6 = $dado[5];
                        $this->dadosDump->campo7 = $dado[6];
                        $this->dadosDump->campo8 = $dado[7];
                        $this->dadosDump->campo9 = $dado[8];
                        if (!$this->dadosDump->save(false))
                            return false;
                    }
                    fclose($handle);
                    unlink('CSV/'.$this->fileCSVName);
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }



    public function getQte()
    {
        return count($this->csvFiles);
    }
}
