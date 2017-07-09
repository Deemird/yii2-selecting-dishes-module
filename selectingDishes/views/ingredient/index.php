<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Ингредиенты';
$this->params['breadcrumbs'][] = $this->title;
Pjax::begin(['enablePushState' => false]);
?>

<div class="row">
    <div class="col-sm-4">
        <h3>Добавить ингредиент</h3>
        <br>
        <?= Yii::$app->controller->renderPartial('_form', ['model' => $model]) ?>
    </div>
    <?php Pjax::begin(['enablePushState' => false]) ?>
    
    <div class="col-sm-8" style="border-left: 1px dotted#ccc;">
        <div id="ingredient_crud">
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
            <span id="loading" class="glyphicon glyphicon-refresh rotate" style="display: none"></span>

            <br>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'id',
                        'label' => '#',
                        'options' => ['style' => ['width' => '10%']]
                    ],
                    [
                        'attribute' =>'name_ingredient',
                        'label' => 'Ингредиент',
                        'options' => ['style' => ['width' => '80%']]
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'Наличие',
                        'value' => function ($data) {
                            if ($data->status == 0) {
                                return 'нет';
                            }
                            return 'есть';
                        },
                        'filter' => ['0' => 'нет', '1' => 'есть'],
                        'options' => ['style' => ['width' => '10%']]
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end() ?>

</div>