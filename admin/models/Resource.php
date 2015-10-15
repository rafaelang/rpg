<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resource".
 *
 * @property integer $defense
 * @property integer $attack
 * @property string $name
 * @property integer $id
 *
 * @property Player[] $players
 */
class Resource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['defense', 'attack'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'defense' => 'Defense',
            'attack' => 'Attack',
            'name' => 'Name',
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayers()
    {
        return $this->hasMany(Player::className(), ['resource_id' => 'id']);
    }
}
