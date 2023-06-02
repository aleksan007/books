<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books_authors".
 *
 * @property int $id
 * @property int $id_book
 * @property int $id_author
 *
 * @property Authors $author
 * @property Books $book
 */
class BooksAuthors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books_authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_book', 'id_author'], 'required'],
            [['id_book', 'id_author'], 'integer'],
            [['id_author'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::class, 'targetAttribute' => ['id_author' => 'id']],
            [['id_book'], 'exist', 'skipOnError' => true, 'targetClass' => Books::class, 'targetAttribute' => ['id_book' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_book' => 'Id Book',
            'id_author' => 'Id Author',
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

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::class, ['id' => 'id_book']);
    }
}
