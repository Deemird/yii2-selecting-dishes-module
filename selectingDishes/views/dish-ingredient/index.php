<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\modules\selectingDishes\models\Ingredient;
use common\modules\selectingDishes\models\Dish;
use common\modules\selectingDishes\models\DishIngredient;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\selectingDishes\models\DishIngredientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список блюд';
$this->params['breadcrumbs'][] = $this->title;
Pjax::begin(['enablePushState' => false]);
?>
<div class="row">
    <div class="col-sm-4">
        <h3 class="center-block">Создать блюдо</h3>
        <br>
        <?= Yii::$app->controller->renderPartial('_form', ['model' => $model]) ?>
    </div>

    <div class="col-sm-8" style="border-left: 1px dotted#ccc;">
        <h3 style="text-align: center"><?= Html::encode($this->title) ?></h3>
        <span id="loading" class="glyphicon glyphicon-refresh rotate" style="display: none"></span>

        <br>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'options' => ['style' => ['width' => '100%']],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
//                'id',
                [
                    'attribute' => 'dish_id',
                    'label' => 'Блюдо',
                    'content' => function($data) {
                        return $data->dish->name;
                    },
                    'filter' => ArrayHelper::map(Dish::find()->asArray()->all(), 'id', 'name'),
                ],
                [
                    'attribute' => 'ingredient_id',
                    'label' => 'Ингредиенты',
                    'content' => function($model, $key, $index, $column) {
                        $array = DishIngredient::find()->where(['dish_id' => $model->dish->id])->all();
                        foreach ($array as $value) {
                            if ($value->ingredient->status == 0) {
                                $ingred = '<span style="color:#ff0000">' . $value->ingredient->name_ingredient . ', </span>';
                            } else {
                                $ingred = '<span>' . $value->ingredient->name_ingredient . ', </span>';
                            }

                            $arrIngred.=$ingred;
                        }
                        return $arrIngred;
                    },
                            'filter' => ArrayHelper::map(Ingredient::find()->asArray()->all(), 'id', 'name_ingredient'),
                ],
                [
                       'class' => 'yii\grid\ActionColumn',
                       'options' => ['style' => ['width' => '7%']],
                       'template' => '{update} {delete}',
                ],
            ],
        ]);
        ?>

        <div><span style="color:#ff0000">*</span> красным выделены отсутствующие ингредиенты</div>

            </div>    
        </div>
        <?php Pjax::end(); ?>