<?php

namespace app\models;

/**
 * This is the model class for table "ordenadores".
 *
 * @property int $id
 * @property string $codigo
 * @property string $marca
 * @property string $modelo
 * @property int $aula_id
 *
 * @property Dispositivos[] $dispositivos
 * @property Aulas $aula
 */
class Ordenadores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordenadores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo'], 'number'],
            [['marca', 'modelo'], 'required'],
            [['aula_id'], 'default', 'value' => null],
            [['aula_id'], 'integer'],
            [['marca', 'modelo'], 'string', 'max' => 255],
            [['codigo'], 'unique'],
            [['aula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aulas::className(), 'targetAttribute' => ['aula_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Codigo',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'aula_id' => 'Aula',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispositivos()
    {
        return $this->hasMany(Dispositivos::className(), ['ordenador_id' => 'id'])->inverseOf('ordenador');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAula()
    {
        return $this->hasOne(Aulas::className(), ['id' => 'aula_id'])->inverseOf('ordenadores');
    }
}
