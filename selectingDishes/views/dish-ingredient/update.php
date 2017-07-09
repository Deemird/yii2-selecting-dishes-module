<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\selectingDishes\models\DishIngredient */

$this->params['breadcrumbs'][] = ['label' => 'Редактирование блюд', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="dish-ingredient-update">

    <?= $this->render('_formUpdate', [
        'model' => $model,
    ]) ?>

</div>
