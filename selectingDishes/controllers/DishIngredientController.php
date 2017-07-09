<?php

namespace common\modules\selectingDishes\controllers;

use Yii;
use common\modules\selectingDishes\models\DishIngredient;
use common\modules\selectingDishes\models\DishIngredientSearch;
use common\modules\selectingDishes\models\DishForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DishIngredientController implements the CRUD actions for DishIngredient model.
 */
class DishIngredientController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all DishIngredient models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new DishForm();
        $searchModel = new DishIngredientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) && $model->saveDish()) {
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single DishIngredient model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DishIngredient model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DishForm();

        if ($model->load(Yii::$app->request->post()) && $model->saveDish()) {
            return $this->redirect(['index']);
        }
        
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing DishIngredient model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelSearch = $this->findModel($id);

        $dish = $this->findDish($modelSearch->dish_id);

        $model = new DishForm();
        $model->name_dish = $modelSearch->dish->name;

        foreach ($dish as $value) {
            $model->ingredients[] = $value['ingredient_id'];
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->updateDish($id);
            return $this->redirect(['index']);
        }
        return $this->render('update', ['model' => $model]);
    }

    /**
     * Deletes an existing DishIngredient model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->dish->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DishIngredient model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DishIngredient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DishIngredient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findDish($dish_id) {
        if (($dish = DishIngredient::findAll(['dish_id' => $dish_id])) !== null) {
            return $dish;
        }
    }
}
