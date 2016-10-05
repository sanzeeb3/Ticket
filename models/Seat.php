<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seat".
 *
 * @property integer $seat_id
 * @property integer $seat
 * @property integer $type
 */
class Seat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seat', 'type'], 'required'],
            [['seat', 'type'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'seat_id' => 'Seat ID',
            'seat' => 'Seat',
            'type' => 'Type',
        ];
    }

    public function getBooks() 
    {
         return $this->hasMany(BookSeat::className(), ['seat_id' => 'seat_id']);
    }

}
