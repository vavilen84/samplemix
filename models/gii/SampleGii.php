<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "sample".
 *
 * @property integer $id
 * @property string $tags
 * @property integer $user_id
 * @property integer $tempo
 * @property string $key
 * @property string $title
 */
class SampleGii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sample';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'tempo'], 'integer'],
            [['tags', 'key', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tags' => 'Tags',
            'user_id' => 'User ID',
            'tempo' => 'Tempo',
            'key' => 'Key',
            'title' => 'Title',
        ];
    }
}
