<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\selectingDishes\models\DishIngredient */

$this->title = 'Create Dish Ingredient';
$this->params['breadcrumbs'][] = ['label' => 'Dish Ingredients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dish-ingredient-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
