<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = 'Добавить Страницу';
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
