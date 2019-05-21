<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $ID
 * @property string $username
 * @property string $password
 */
class backedUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }
}
