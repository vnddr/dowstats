<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maps".
 *
 * @property integer $id
 * @property integer $type
 * @property string $title
 * @property string $gametitle
 * @property string $image
 */
class Map extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'maps';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['title', 'gametitle'], 'string', 'max' => 45],
            [['image'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'title' => 'Title',
            'gametitle' => 'Gametitle',
            'image' => 'Image',
        ];
    }
}
