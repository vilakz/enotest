<?php
/**
 * Created by PhpStorm.
 * User: Vasiliy Vinogradov
 * Date: 10/16/18
 * Time: 6:25 PM
 */
namespace frontend\widgets;

use frontend\models\CommentForm;

class CommentWidget extends \yii\base\Widget
{
    /**
     * Страница
     * @var integer
     */
    public $articleId = null;

    public function run()
    {
        $model = \Yii::createObject([
            'class' => CommentForm::class,
            'article_id' => $this->articleId,
        ]);
        return $this->render('comment', compact('model'));
    }
}