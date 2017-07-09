<?php

namespace common\modules\selectingDishes\models;

use Yii;

/**
 * This is the model class for table "dish_ingredient".
 *
 * @property integer $id
 * @property integer $dish_id
 * @property integer $ingredient_id
 *
 * @property Ingredient $ingredient
 * @property Dish $dish
 */
class DishIngredient extends \yii\db\ActiveRecord
{
    const STATUS_NOT_AVAILABLE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dish_ingredient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dish_id', 'ingredient_id'], 'required'],
            [['dish_id', 'ingredient_id'], 'integer'],
            [['ingredient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredient::className(), 'targetAttribute' => ['ingredient_id' => 'id']],
            [['dish_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dish::className(), 'targetAttribute' => ['dish_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dish_id' => 'Dish ID',
            'ingredient_id' => 'Ingredient ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredient()
    {
        return $this->hasOne(Ingredient::className(), ['id' => 'ingredient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dish::className(), ['id' => 'dish_id']);
    }

    public static function getQuery($selectedIngredient) {
        $query = DishIngredient::find()
                ->select('dish_ingredient.dish_id,count(ingredient.id) as count_math,')
                ->leftJoin('ingredient', 'ingredient.id=dish_ingredient.ingredient_id')
                ->andWhere(['in', 'ingredient.id', $selectedIngredient])
                ->groupBy('dish_ingredient.dish_id')
                ->having('count(ingredient_id)>=2')
                ->orderBy('count_math DESC')
                ->asArray();
        return $query;
    }
}
