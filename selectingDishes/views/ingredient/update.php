<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\selectingDishes\models\Ingredient */

$this->title = 'Обновить ингредиент: ' . $model->name_ingredient;
$this->params['breadcrumbs'][] = ['label' => 'Ингредиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_ingredient, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="ingredient-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <?= $this->render('_form', [
        'model' => $model,
        'id'=>$id
    ]) ?>

</div>
