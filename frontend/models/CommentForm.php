<?php
namespace frontend\models;

use common\models\Article;

/**
 * Created by PhpStorm.
 * User: Vasiliy Vinogradov
 * Date: 10/16/18
 * Time: 6:53 PM
 */

class CommentForm extends \yii\base\Model
{
    public $body;

    public $article_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['article_id'], 'integer'],
            [
                ['article_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Article::class,
                'targetAttribute' => ['article_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'body' => 'Комментарий',
            'article_id' => 'Страница',
        ];
}
}