<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aulas".
 *
 * @property int $id
 * @property string $numero
 * @property string $denominacion
 *
 * @property Dispositivos[] $dispositivos
 * @property Ordenadores[] $ordenadores
 */
class Aulas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aulas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero'], 'number'],
            [['denominacion'], 'string', 'max' => 255],
            [['numero'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero' => 'Numero',
            'denominacion' => 'Denominacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispositivos()
    {
        return $this->hasMany(Dispositivos::className(), ['aula_id' => 'id'])->inverseOf('aula');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenadores()
    {
        return $this->hasMany(Ordenadores::className(), ['aula_id' => 'id'])->inverseOf('aula');
    }
}
