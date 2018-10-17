<?php
/**
 * Created by PhpStorm.
 * User: Vasiliy Vinogradov
 * Date: 10/16/18
 * Time: 5:46 PM
 */

/* @var $this yii\web\View */
/* @var $model \common\models\Article */

?>
<div class="panel panel-default">
    <div class="panel-heading"><?= $model->title ?></div>
    <a href="<?= \yii\helpers\Url::to(['site/article', 'id' => $model->id]) ?>">
        <div class="panel-body">
            <?= \yii\helpers\StringHelper::truncate(nl2br($model->body), 70, '...', null, true); ?>
        </div>
    </a>
    <div class="panel-footer">
        <ul class="list-inline">
            <li><?= $model->user->username ?> </li>
            <li><?= Yii::$app->formatter->asDatetime($model->created_at) ?> </li>
            <li>
                <a href="<?= \yii\helpers\Url::to(['site/article', 'id' => $model->id, '#' => 'comments']) ?>">
                    <?= \Yii::t('app', '{n, plural, one{# комментарий} few{# комментария} many{# комментариев} other{# комментария}} ', ['n' => count($model->okComments)]); ?>
                </a>
            </li>
        </ul>
    </div>
</div>


