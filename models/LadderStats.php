<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ladder_stats".
 *
 * @property integer $ladder_id
 * @property integer $player_id
 * @property integer $games_count
 * @property integer $mmr
 * @property double $apm_total
 * @property integer $fav_race_id
 * @property integer $victories
 */
class LadderStats extends \yii\db\ActiveRecord
{
    public $apm;
    public $winPercent;

    public $ladderTitle;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ladder_stats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ladder_id', 'player_id'], 'required'],
            [['ladder_id', 'player_id', 'games_count', 'mmr', 'fav_race_id', 'victories'], 'integer'],
            [['apm_total'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ladder_id' => 'Ladder ID',
            'player_id' => 'Player ID',
            'games_count' => 'Games Count',
            'mmr' => 'Mmr',
            'apm_total' => 'Apm Total',
            'fav_race_id' => 'Fav Race ID',
            'victories' => 'Victories',
        ];
    }

    public function getPlayer()
    {
        return $this->hasOne(Player::className(), ['id' => 'player_id']);
    }

    public function getRace()
    {
        return $this->hasOne(Race::className(), ['id' => 'fav_race_id']);
    }

    public function getLadder()
    {
        return $this->hasOne(Ladder::className(), ['id' => 'ladder_id']);
    }
}
