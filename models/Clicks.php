<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clicks".
 *
 * @property integer $id
 * @property integer $unique_clicks
 * @property integer $click
 * @property string $country_code
 * @property string $date
 * @property integer $record_id
 *
 * @property News $record
 */
class Clicks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clicks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unique_clicks', 'click', 'record_id'], 'integer'],
            [['click', 'country_code', 'record_id'], 'required'],
            [['date'], 'safe'],
            [['country_code'], 'string', 'max' => 3],
            [['record_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['record_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unique_clicks' => 'Unique Clicks',
            'click' => 'Click',
            'country_code' => 'Country Code',
            'date' => 'Date',
            'record_id' => 'Record ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecord()
    {
        return $this->hasOne(News::className(), ['id' => 'record_id']);
    }
}
