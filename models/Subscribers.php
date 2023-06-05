<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscribers".
 *
 * @property int $id
 * @property string $phone
 * @property int $id_author
 *
 * @property Authors $author
 */
class Subscribers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscribers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'id_author'], 'required'],
            [['id_author'], 'integer'],
            [['phone'], 'string', 'max' => 12],
            [['phone', 'id_author'], 'unique', 'targetAttribute' => ['phone', 'id_author']],
            [['id_author'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::class, 'targetAttribute' => ['id_author' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'phone' => 'Номер телефона',
            'id_author' => 'Автор',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::class, ['id' => 'id_author']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        \Yii::$app->getSession()->setFlash('success', 'Вы успешно подписались');
        parent::afterSave($insert, $changedAttributes);
    }
}
