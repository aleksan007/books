<?php

namespace app\models\reports;


use yii\base\Model;

class TopAuthors extends Model
{
    public $year;
    public $count = 10;

    public function rules()
    {
        return [
            [['year','count'], 'required'],
            [['year'], 'integer'],
            [['count'], 'integer','min' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'year' => 'Год',
            'count' => 'Количество записей',
        ];
    }
}
