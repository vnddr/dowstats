<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ladder".
 *
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $date_start
 * @property string $date_end
 */
class Ladder extends \yii\db\ActiveRecord
{
    const DEFAULT_MMR = 1500;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ladder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_start', 'date_end'], 'safe'],
            [['url'], 'string', 'max' => 45],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'title' => 'Title',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
        ];
    }

    // TODO: это связи на случай, если понадобится сделать 1 ладдер на больше чем 1 тип игр
//    public function getLadderGametype()
//    {
//        return $this->hasOne(Ladder2gametype::className(), ['ladder_id' => 'id']);
//    }
//
//    public function getGametype()
//    {
//        return $this->hasOne(GameType::className(), ['id' => 'gametype_id'])
//            ->via('gamePlayers');
//    }

    public function getGametype()
    {
        return $this->hasOne(GameType::className(), ['id' => 'gametype_id']);
    }
}
