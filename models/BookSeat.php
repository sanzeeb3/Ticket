<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book_seat".
 *
 * @property string $seat_id
 * @property integer $id
 * @property integer $user_id
 * @property string $date_booked
 */
class BookSeat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_seat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['date_booked'], 'safe'],
            [['seat_id'], 'string', 'max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'seat_id' => 'Seat ID',
            'id' => 'ID',
            'user_id' => 'User ID',
            'date_booked' => 'Date Booked',
        ];
    }

    public function getSeat() 
    {
         return $this->hasOne(Seat::className(), ['seat_id' => 'seat_id']);
    }

    public function getUser() 
    {
         return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }
}
