<?php

use common\models\Comment;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить Комментарий', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'article_id',
                'value' => function ($model) {
                    /* @var $model Comment */
                    return $model->article->title;
                },
            ],
            [
                'format' => 'raw',
                'attribute' => 'body',
                'value' => function ($model) {
                    /* @var $model Comment */
                    return \yii\helpers\StringHelper::truncate(nl2br($model->body), 70, '...', null, true);
                },
            ],
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    /* @var $model Comment */
                    return $model->user->username;
                },
                'filter' => \common\models\User::getUserList(),
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'status',
                'value' => function ($model) {
                    /* @var $model Comment */
                    return Comment::getStatusList()[$model->status];
                },
                'filter' => Comment::getStatusList(),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'options' => [
                        'placeholder' => 'Выберите статус',
                    ],
                ],
                'editableOptions' => [
                    'header' => 'Выберите статус',
                    'size' => 'lg',
                    'inputType' => \kartik\editable\Editable::INPUT_RADIO_LIST,
                    'data' => Comment::getStatusList(),
                ],
            ],
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
