<?php

/**
 * Created by PhpStorm.
 * User: Vasiliy Vinogradov
 * Date: 10/16/18
 * Time: 6:19 PM
 */

use common\models\Article;
use frontend\widgets\CommentWidget;

/* @var $this \yii\web\View */
/* @var $model Article */

?>

<div class="panel panel-default">
    <div class="panel-heading"><?= $model->title ?></div>
    <div class="panel-body">
        <?= nl2br($model->body) ?>
    </div>
    <div class="panel-footer">
        <ul class="list-inline">
            <li><?= $model->user->username ?> </li>
            <li><?= Yii::$app->formatter->asDatetime($model->created_at) ?> </li>
            <li><?= \Yii::t('app',
                    '{n, plural, one{# комментарий} few{# комментария} many{# комментариев} other{# комментария}} ',
                    ['n' => count($model->okComments)]); ?></li>
        </ul>
    </div>
</div>
<div class="list-group" id="comments">
    <h4>Комментарии:</h4>
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => \Yii::createObject([
            'class' => \yii\data\ArrayDataProvider::class,
            'allModels' => $model->okComments,
        ]),
        'itemView' => '_comment_item',
        'summary' => '',
    ]) ?>
</div>
<?php if (!Yii::$app->user->isGuest) : ?>
    <?= CommentWidget::widget(['articleId' => $model->id]) ?>
<?php else : ?>
    <h4><?= \yii\helpers\Html::a('Войдите', ['site/login']) ?> или <?= \yii\helpers\Html::a('зарегистрируйтесь', ['site/signup']) ?>, чтобы добавить комментарий</h4>
<?php endif; ?>