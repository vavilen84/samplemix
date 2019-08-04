<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "collection".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $json
 */
class CollectionGii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['json'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'json' => 'Json',
        ];
    }
}
