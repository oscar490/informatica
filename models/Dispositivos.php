<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dispositivos".
 *
 * @property int $id
 * @property string $codigo
 * @property string $marca
 * @property string $modelo
 * @property int $tipo_id
 * @property int $ordenador_id
 * @property int $aula_id
 *
 * @property Aulas $aula
 * @property Ordenadores $ordenador
 * @property Tipo $tipo
 */
class Dispositivos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dispositivos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo'], 'number'],
            [['marca', 'modelo'], 'required'],
            [['tipo_id', 'ordenador_id', 'aula_id'], 'default', 'value' => null],
            [['tipo_id', 'ordenador_id', 'aula_id'], 'integer'],
            [['marca', 'modelo'], 'string', 'max' => 255],
            [['codigo'], 'unique'],
            [['aula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aulas::className(), 'targetAttribute' => ['aula_id' => 'id']],
            [['ordenador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenadores::className(), 'targetAttribute' => ['ordenador_id' => 'id']],
            [['tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipo::className(), 'targetAttribute' => ['tipo_id' => 'id']],
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
            'tipo_id' => 'Tipo ID',
            'ordenador_id' => 'Ordenador ID',
            'aula_id' => 'Aula ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAula()
    {
        return $this->hasOne(Aulas::className(), ['id' => 'aula_id'])->inverseOf('dispositivos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenador()
    {
        return $this->hasOne(Ordenadores::className(), ['id' => 'ordenador_id'])->inverseOf('dispositivos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(Tipo::className(), ['id' => 'tipo_id'])->inverseOf('dispositivos');
    }
}
