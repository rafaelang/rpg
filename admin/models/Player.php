<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "player".
 *
 * @property integer $resource_id
 * @property integer $speed
 * @property integer $strong
 * @property integer $life
 * @property string $name
 * @property integer $id
 *
 * @property Resource $resource
 */
class Player extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'player';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['resource_id', 'name'], 'required'],
            [['resource_id', 'speed', 'strong', 'life'], 'integer'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'resource_id' => 'Resource ID',
            'speed' => 'Speed',
            'strong' => 'Strong',
            'life' => 'Life',
            'name' => 'Name',
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['id' => 'resource_id']);
    }
}
