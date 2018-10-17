<?php
/**
 * Created by PhpStorm.
 * User: Vasiliy Vinogradov
 * Date: 10/16/18
 * Time: 6:52 PM
 */

use frontend\models\CommentForm;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model CommentForm */

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'article_id', ['options' => ['tag' => false], 'template' => '{input}'])->hiddenInput() ?>

<?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success js-comment-submit']) ?>
</div>

    <div class="loader"
         style="display: none; position: absolute; top: 0; bottom: 0; left: 0; right: 0; background-color: rgba(234,243,241,0.56);">
        <div style="width: 100%;height: 100%; display: flex;">
            <div class="loader-center" style="margin: auto;">
                <img src="/gif-load.gif">
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>

<?= \yii\bootstrap\Modal::widget([
    'id' => 'comment-dialog',
    'header' => '<h4>Добавление комментария</h4>',
]) ?>
<?php
$strJs =<<<JS

$('.js-comment-submit').on('click', function(event) {
    event.preventDefault();
    var form = $(this).parents('form');
    var oldPosition = form.css('position');
    form.css('position', 'relative');
    form.find('.loader').show();
    $.ajax({
        data: form.serializeArray(),
        url: '/site/add-comment',
        method: "post",
        cache: false
    })
    .done(function(data, textStatus, jqXHR) {
        var str = '';
        if (data.result) {
            str = 'Комментарий успешно добавлен, после модерации он будет опубликован';
        } else {
            str = 'Ошибка добавления комментария. <pre>' + JSON.stringify(data.errors) + '</pre>';
        }
        form.find('#commentform-body').val('');
        $('#comment-dialog .modal-body').html(str);
        $('#comment-dialog').modal();
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        $('#comment-dialog .modal-body').html('Ошибка отправки комментария ' + textStatus + ', ' + errorThrown);
        $('#comment-dialog').modal();
    })
    .always(function() {
        form.css('position', oldPosition);
        form.find('.loader').hide();
    })
    ;
});
JS;
$this->registerJs($strJs);
