<?php

namespace common\modules\selectingDishes\models;

use Yii;

/**
 * This is the model class for table "ingredient".
 *
 * @property integer $id
 * @property string $name_ingredient
 * @property integer $status
 *
 * @property DishIngredient[] $dishIngredients
 */
class Ingredient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingredient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_ingredient'], 'required'],
            [['status'], 'integer'],
            [['name_ingredient'], 'string', 'max' => 75],
            [['name_ingredient'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_ingredient' => 'Name Ingredient',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishIngredients()
    {
        return $this->hasMany(DishIngredient::className(), ['ingredient_id' => 'id']);
    }
}
