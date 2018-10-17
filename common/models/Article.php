<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title Заголовок
 * @property string $body Текст
 * @property int $user_id Автор
 * @property int $created_at Время создания
 * @property int $updated_at Время редактирования
 *
 * @property User $user
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('UNIX_TIMESTAMP()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 1024],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'body' => 'Текст',
            'user_id' => 'Автор',
            'created_at' => 'Время создания',
            'updated_at' => 'Время редактирования',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOkComments()
    {
        return $this->getComments()->andWhere([Comment::tableName().'.status' => Comment::STATUS_OK ]);
    }

    /**
     * Получить список страниц
     * @return array
     */
    public static function getArticleList()
    {
        return static::find()->select(['title', 'id'])->indexBy('id')->column();
    }
}
