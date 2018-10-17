<?php

use common\models\Comment;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Комментарии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот комментарий ?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить Комментарий', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'article_id',
                'value' => function ($model) {
                    /* @var $model Comment */
                    return $model->article->title;
                },
            ],
            'body:ntext',
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    /* @var $model Comment */
                    return $model->user->username;
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    /* @var $model Comment */
                    return Comment::getStatusList()[$model->status];
                },
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
