<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "games".
 *
 * @property integer $id
 * @property string $map
 * @property integer $game_time
 * @property string $replay_link
 * @property integer $downloads
 * @property string $game_mod
 * @property integer $type
 * @property string $ipreal
 * @property integer $confirmed
 * @property string date
 */
class Game extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'games';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_time', 'downloads', 'type', 'confirmed'], 'integer'],
            [['map', 'date'], 'string', 'max' => 50],
            [['replay_link'], 'string', 'max' => 200],
            [['game_mod'], 'string', 'max' => 20],
            [['ipreal'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'map' => 'Map',
            'game_time' => 'Game Time',
            'replay_link' => 'Replay Link',
            'downloads' => 'Downloads',
            'game_mod' => 'Game Mod',
            'type' => 'Type',
            'ipreal' => 'Ipreal',
            'confirmed' => 'Confirmed',
            'date' => 'Date',
        ];
    }

    /**
     * Relation with Players table
     * @return $this
     */
    public function getGamePlayers()
    {
        return $this->hasMany(Players2games::className(), ['game_id' => 'id']);
    }

    public function getPlayers()
    {
        return $this->hasMany(Player::className(), ['id' => 'player_id'])
            ->via('gamePlayers');
    }

    public function getMapmodel()
    {
        return $this->hasOne(Map::className(), ['gametitle' => 'map']);
    }


}
