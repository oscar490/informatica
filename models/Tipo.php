<?php

namespace app\models;

/**
 * This is the model class for table "tipo".
 *
 * @property int $id
 * @property string $denominacion
 *
 * @property Dispositivos[] $dispositivos
 */
class Tipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denominacion'], 'string', 'max' => 255],
            [['denominacion'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denominacion' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispositivos()
    {
        return $this->hasMany(Dispositivos::className(), ['tipo_id' => 'id'])->inverseOf('tipo');
    }
}
