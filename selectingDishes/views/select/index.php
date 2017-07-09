<?php

use yii\bootstrap\Html;
?>
    <?=
    	Yii::$app->controller->renderPartial('_ingredient', [
            'ingredients' => $ingredients,
            'selectedIngredient' => $selectedIngredient,
            'dishes' => $dishes,
        ]);
    ?>    
