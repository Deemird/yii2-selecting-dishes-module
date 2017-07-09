<?php

namespace common\modules\selectingDishes\models;

use Yii;
use yii\base\Model;
use common\modules\selectingDishes\models\DishIngredient;
use common\modules\selectingDishes\models\Dish;

/**
 * DishForm is the model behind the edit dish form.
 */
class DishForm extends Model {

    public $ingredients;
    public $name_dish;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['name_dish', 'required'],
            [['name_dish'], 'string', 'max' => 125],
            ['ingredients', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'name_dish' => 'Название блюда',
            'ingredients' => 'Список ингредиентов',
        ];
    }

    public function saveDish() {
        if ($this->ingredients) {
            $dish = new Dish();
            $dish->name = $this->name_dish;
            try {
                $dish->save();
            } catch (\yii\db\Exception $e) {
                if ($e->errorInfo[0] == '23000' && $e->errorInfo[1] == '1062') {
                    Yii::$app->session->setFlash('error', 'Ошибка. Данное блюдо уже имеется в БД');

                    return false;
                }
            }
            $idDish = $dish->id;
            foreach ($this->ingredients as $ingredient) {
                $dishIngredient = new DishIngredient();

                $dishIngredient->ingredient_id = $ingredient;
                $dishIngredient->dish_id = $idDish;
                $dishIngredient->save();
            }
            return true;
        }
    }

    public function updateDish($id) {

        $dishIngredient = $this->findDishIngredient($id);
        $dishId = $dishIngredient->dish_id;

        $countDelRow = sizeof($this->findDishIngredients($dishId)) - sizeof($this->ingredients);

        if ($countDelRow > 0) {
            $this->deleteRow($countDelRow, $dishId);
        }

        $dishIngredient->dish->name = $this->name_dish;
        $dishIngredient->dish->save();

        $dishIngredients = $this->findDishIngredients($dishId);

        $i = 0;

        while ($i < count($this->ingredients)) {
            if ($i >= count($dishIngredients)) {
                $newDishIngredient = new DishIngredient();
                $newDishIngredient->ingredient_id = $this->ingredients[$i];
                $newDishIngredient->dish_id = $dishId;
                $newDishIngredient->save();
                $i++;
                continue;
            }
            
            foreach ($dishIngredients as $row) {
                $row->ingredient_id = $this->ingredients[$i];
                $row->save();
                $i++;
            }
        }

        return true;
    }

    protected function deleteRow($count, $dishId) {
        $dishIngredients = $this->findDishIngredients($dishId);

        foreach ($dishIngredients as $row) {
            while ($count > 0) {
                $row->delete();
                $count--;
                break;
            }
        }
    }

    protected function findDishIngredient($id) {
        return DishIngredient::findOne($id);
    }

    protected function findDishIngredients($dishId) {
        return DishIngredient::findAll(['dish_id' => $dishId]);
    }

}