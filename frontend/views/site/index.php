<?php

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'Тестовое задание страницы и комментарии';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <?= \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_article_item',
                    'summary' => '',
                ]) ?>
            </div>
        </div>
    </div>
</div>
