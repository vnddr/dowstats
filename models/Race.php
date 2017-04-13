<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "races".
 *
 * @property integer $id
 * @property string $title
 * @property string $icon
 */
class Race extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'races';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 45],
            [['icon'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'icon' => 'Icon',
        ];
    }

    public static $icons = [
        1 => '/img/sm.png',
        2 => '/img/eldar.png',
        3 => '/img/orks.png',
        4 => '/img/csm.png',
        5 => '/img/ig.png',
        6 => '/img/necr.png',
        7 => '/img/tau.png',
        8 => '/img/sob.png',
        9 => '/img/de.png'
    ];
}
