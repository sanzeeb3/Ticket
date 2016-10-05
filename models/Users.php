<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $user_id
 * @property string $name
 * @property string $contact
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $token
 * @property integer $status
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name', 'contact', 'email', 'username'], 'string', 'max' => 30],
            [['password', 'token'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Name',
            'contact' => 'Contact',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'token' => 'Token',
            'status' => 'Status',
        ];
    }

    public function getBooks() 
    {
         return $this->hasMany(BookSeat::className(), ['user_id' => 'user_id']);
    }
}
