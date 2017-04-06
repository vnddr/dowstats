<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "players2games".
 *
 * @property integer $game_id
 * @property integer $player_id
 * @property double $apm
 */
class Players2games extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'players2games';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'player_id'], 'required'],
            [['game_id', 'player_id'], 'integer'],
            [['apm'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'game_id' => 'Game ID',
            'player_id' => 'Player ID',
            'apm' => 'Apm',
        ];
    }
}
