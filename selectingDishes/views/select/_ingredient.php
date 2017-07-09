<?php

use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

Pjax::begin(['id' => 'pjax_ingredient', 'enablePushState' => false]);
?>
<div class="container">
    <h3>Ингредиенты</h3>

    <?php foreach ($ingredients as $ingredient): ?>
        <?php if (in_array($ingredient->id, $selectedIngredient)): ?>
            <?php $btnClass = 'btn btn-primary'; ?>
        <?php else: ?>
            <?php $btnClass = 'btn btn-default'; ?>
        <?php endif; ?>

        <?= Html::a($ingredient->name_ingredient, Url::to(['/selectingDishes/select/choose-ingredient', 'id' => $ingredient->id]), ['class' => $btnClass, 'style' => 'margin:1px']) ?>

    <?php endforeach; ?>

    <br>
    <br>
    <p><?= count(Yii::$app->session->get('selectedIngredient')) >= 5 ? 'Можно выбрать не более 5 ингредиентов' : '&nbsp;' ?></p>

    <hr style="margin: 20px 0; border: 1px solid #ccc;" />

</div>

<div class="container">
    <?= Yii::$app->controller->renderPartial('_dish', ['dishes' => $dishes]) ?>
</div>
<?php Pjax::end() ?>