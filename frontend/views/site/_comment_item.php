<?php
/**
 * Created by PhpStorm.
 * User: Vasiliy Vinogradov
 * Date: 10/16/18
 * Time: 6:30 PM
 */

/* @var $this yii\web\View */
/* @var $model \common\models\Comment */

?>

<a href="#" class="list-group-item">
    <h4 class="list-group-item-heading"><?= $model->user->username ?> <?= \Yii::$app->formatter->asDatetime($model->created_at) ?></h4>
    <p class="list-group-item-text"><?= nl2br($model->body) ?></p>
</a>

