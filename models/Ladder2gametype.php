<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ladder2gametype".
 *
 * @property integer $id
 * @property integer $ladder_id
 * @property integer $gametype_id
 */
class Ladder2gametype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ladder2gametype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ladder_id', 'gametype_id'], 'required'],
            [['ladder_id', 'gametype_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ladder_id' => 'Ladder ID',
            'gametype_id' => 'Gametype ID',
        ];
    }
}
