<?php

namespace common\modules\selectingDishes\controllers;

use yii\web\Controller;
use common\modules\selectingDishes\models\Ingredient;
use common\modules\selectingDishes\models\DishIngredient;
use Yii;

/**
 * Default controller for the `selectingDishes` module
 */
class SelectController extends Controller
{
	/**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->session->remove('selectedIngredient');
        $ingredients = Ingredient::find()->all();
        $dishes = $this->getDishes();

        return $this->render('index', [
                    'ingredients' => $ingredients,
                    'dishes' => $dishes,
                    'selectedIngredient' => $this->getSession(),
        ]);
    }

	public function actionChooseIngredient($id) 
    {
        $this->setSession($id);
        $this->showIngredient();
    }

    public function showIngredient() 
    {
        $ingredients = Ingredient::find()->all();
        
        return $this->renderAjax('_ingredient', [
                    'ingredients' => $ingredients,
                    'selectedIngredient' => $this->getSession(),
                    'dishes' => $this->getDishes(),
        ]);
    }

    private function setSession($id) 
    {
        $selectedIngredients = $this->getSession();
        if (!in_array($id, $selectedIngredients) && sizeof($selectedIngredients) <= 4) {
            $selectedIngredients[] = $id;
        } else {
            $key = array_search($id, $selectedIngredients);
            if ($key !== false)
                unset($selectedIngredients[$key]);
        }
        Yii::$app->session->set('selectedIngredient', $selectedIngredients);
    }

    private function getSession() 
    {
        return Yii::$app->session->get('selectedIngredient') ? : [];
    }

    public function getDishes() 
    {
        $selectedIngredient = $this->getSession();
        $query = DishIngredient::getQuery($selectedIngredient)->all();
        if (sizeof($selectedIngredient) < 2 ) {
            return array('' => '<span style="color:red">Выберите больше ингредиентов</span>');
        }
        
        if (empty($query)) {
            return array('' => 'Ничего не найдено');
        }

        foreach ($query as $value) {
            $ingredients = [];
            $qr = DishIngredient::find()->with('ingredient')->where(['dish_id' => $value['dish_id']]);
            $dish = $qr->all();
            $count = $qr->count();
            
            foreach ($dish as $valueDish) {
                if($valueDish->ingredient->status==DishIngredient::STATUS_NOT_AVAILABLE){
                    continue 2;
                }
                $ingredients[] = $valueDish->ingredient->name_ingredient;
            }
            
            $strIngredients = implode(', ', $ingredients);
            $strDishName=$valueDish->dish->name.' (  совпадений - '.$value['count_math'].')';
            if ($value['count_math'] == $count && $count == sizeof($selectedIngredient)) {
                $exactDish[$strDishName] = $strIngredients;
            }
            $rightDish[$strDishName] = $strIngredients;
        }

        return (!empty($exactDish)) ? $exactDish : $rightDish;
    }
}
