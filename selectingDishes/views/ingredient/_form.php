<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
Pjax::begin(['id'=>'pjax_ingredient','enablePushState'=>false]);
?>

<div class="ingredient-form">

    <?php $form = ActiveForm::begin([
        'action'=>  \yii\helpers\Url::to(['create-update','id'=>$id]),
        'options'=>['data-pjax'=>true],
    ]); ?>

    <?= $form->field($model, 'name_ingredient')->textInput(['maxlength' => true])->label('Название') ?>
    <?= $form->field($model, 'status')->checkbox(['label' => 'Наличие'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php Pjax::end() ?>