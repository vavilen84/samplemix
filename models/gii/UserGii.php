<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $nickname
 * @property string $email
 * @property string $password
 * @property integer $status
 * @property integer $role
 * @property integer $resource
 */
class UserGii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'role', 'resource'], 'integer'],
            [['nickname', 'email', 'password'], 'string', 'max' => 255],
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
            'email' => 'Email',
            'password' => 'Password',
            'status' => 'Status',
            'role' => 'Role',
            'resource' => 'Resource',
        ];
    }
}
