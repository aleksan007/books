<?php

namespace app\models;

use app\components\repositories\AuthorRepository;
use app\components\repositories\BookRepository;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property int $id_author
 * @property string $name
 * @property int $year
 * @property string $isbn
 * @property string $photo
 * @property string $description
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Authors $author
 */
class Books extends \yii\db\ActiveRecord
{
    public $idAuthor;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'year', 'isbn', 'photo', 'description','idAuthor'], 'required'],
            [['year'], 'integer', 'max' => date('Y')],
            [['photo'], 'string'],
            [['created_at', 'updated_at','idAuthor'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['isbn'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 300],
            [['isbn'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'year' => 'Год',
            'isbn' => 'Isbn',
            'photo' => 'Ссылка на фото',
            'description' => 'Описание',
            'idAuthor' => 'Автор',
            'authors' => 'Авторы',
        ];
    }


    /**
     * Gets query for [[BooksAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooksAuthors()
    {
        return $this->hasMany(BooksAuthors::class, ['id_book' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        AuthorRepository::setAuthors($this);

        if($insert) {
            $repository = new BookRepository();
            $repository->sendToSubscribersSms($this);
        }

        parent::afterSave($insert, $changedAttributes);
    }

    public function afterFind()
    {
        $authors = $this->booksAuthors;
        $this->idAuthor = ArrayHelper::getColumn($authors,'id_author');
        parent::afterFind();
    }
}
