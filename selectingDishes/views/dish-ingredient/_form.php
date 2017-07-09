<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\selectingDishes\models\Ingredient;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\modules\selectingDishes\models\DishIngredient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dish-ingredient-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_dish')->textInput() ?>

    <?=
    $form->field($model, 'ingredients')->listBox(ArrayHelper::map(
                    Ingredient::find()->all(), 'id', 'name_ingredient'), ['multiple' => 'true', 'size' => 20])
    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
