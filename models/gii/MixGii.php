<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "mix".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $json
 * @property integer $status
 */
class MixGii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mix';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
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
            'status' => 'Status',
        ];
    }
}
