<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'article_id')->widget(kartik\select2\Select2::class, [
        'data' => \common\models\Article::getArticleList(),
        'options' => [
            'multiple' => false,
            'placeholder' => 'Выберите статью',
        ],

    ]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id')->widget(kartik\select2\Select2::class, [
        'data' => \common\models\User::getUserList(),
        'options' => [
            'multiple' => false,
            'placeholder' => 'Выберите автора',
        ],
    ]) ?>

    <?= $form->field($model, 'status')->widget(kartik\select2\Select2::class, [
        'data' => \common\models\Comment::getStatusList(),
        'options' => [
            'multiple' => false,
            'placeholder' => 'Выберите статус',
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
