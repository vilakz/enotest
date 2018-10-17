<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $article_id Страница
 * @property string $body Текст
 * @property int $user_id Автор
 * @property int $status Статус
 * @property int $created_at Время создания
 * @property int $updated_at Время редактирования
 *
 * @property Article $article
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * Модерация
     */
    const STATUS_MODERATON = 1;

    /**
     * Разрешен
     */
    const STATUS_OK = 2;

    /**
     * Отклонен
     */
    const STATUS_REJECTED = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
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
            [['article_id', 'user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['status'], 'in', 'range' => array_keys(static::getStatusList())],
            [['body'], 'string'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::class, 'targetAttribute' => ['article_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Страница',
            'body' => 'Текст',
            'user_id' => 'Автор',
            'status' => 'Статус',
            'created_at' => 'Время создания',
            'updated_at' => 'Время редактирования',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::class, ['id' => 'article_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Получить список статусов
     * @return array
     */
    public static function getStatusList()
    {
        $ret = [
            static::STATUS_MODERATON => 'Модерация',
            static::STATUS_OK => 'Разрешен',
            static::STATUS_REJECTED => 'Отклонен',
        ];
        return $ret;
    }
}
