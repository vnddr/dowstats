<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "players".
 *
 * @property integer $id
 * @property string $nickname
 * @property string $avatar
 * @property string $sid
 * @property string $last_active
 */
class Player extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'players';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_active'], 'safe'],
            [['nickname'], 'string', 'max' => 80],
            [['avatar'], 'string', 'max' => 200],
            [['sid'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => 'Nickname',
            'avatar' => 'Avatar',
            'sid' => 'Sid',
            'last_active' => 'Last Active',
        ];
    }

    /**
     * Relation with Games table
     * @return $this
     */
    public function getGamePlayers()
    {
        return $this->hasMany(Players2games::className(), ['player_id' => 'id']);
    }

    public function getGames()
    {
        return $this->hasMany(Game::className(), ['id' => 'game_id'])
            ->via('gamePlayers');
    }
}
