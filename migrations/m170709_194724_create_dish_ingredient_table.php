<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dish_ingredient`.
 * Has foreign keys to the tables:
 *
 * - `dish`
 * - `ingredient`
 */
class m170709_194724_create_dish_ingredient_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%dish_ingredient}}', [
            'id' => $this->primaryKey(),
            'dish_id' => $this->integer(11)->notNull(),
            'ingredient_id' => $this->integer(11)->notNull(),
        ]);

        // creates index for column `dish_id`
        $this->createIndex(
            'idx-dish_ingredient-dish_id',
            'dish_ingredient',
            'dish_id'
        );

        // add foreign key for table `dish`
        $this->addForeignKey(
            'fk-dish_ingredient-dish_id',
            'dish_ingredient',
            'dish_id',
            'dish',
            'id',
            'CASCADE'
        );

        // creates index for column `ingredient_id`
        $this->createIndex(
            'idx-dish_ingredient-ingredient_id',
            'dish_ingredient',
            'ingredient_id'
        );

        // add foreign key for table `ingredient`
        $this->addForeignKey(
            'fk-dish_ingredient-ingredient_id',
            'dish_ingredient',
            'ingredient_id',
            'ingredient',
            'id',
            'CASCADE'
        );

        $this->batchInsert('{{%dish_ingredient}}', ['id', 'dish_id', 'ingredient_id'], [
            ['1', '1', '1'],
            ['2', '1', '4'],
            ['3', '1', '5'],
            ['4', '1', '6'],
            ['5', '1', '7'],
            ['6', '1', '10'],
            ['7', '2', '2'],
            ['8', '2', '7'],
            ['9', '2', '8'],
            ['10', '2', '9'],
            ['11', '2', '11'],
            ['12', '2', '12'],
            ['13', '2', '13'],
            ['14', '2', '14'],
            ['15', '3', '3'],
            ['16', '3', '10'],
            ['17', '3', '15'],
            ['18', '3', '17'],
            ['19', '3', '19'],
            ['20', '3', '20'],
            ['21', '3', '21'],
            ['22', '4', '3'],
            ['23', '4', '9'],
            ['24', '4', '12'],
            ['25', '4', '19'],
            ['26', '4', '22'],
            ['27', '4', '23'],
            ['28', '4', '24'],
            ['29', '4', '25'],
            ['30', '5', '7'],
            ['31', '5', '12'],
            ['32', '5', '16'],
            ['33', '5', '26'],
            ['34', '6', '2'],
            ['35', '6', '3'],
            ['36', '6', '5'],
            ['37', '6', '7'],
            ['38', '6', '12'],
            ['39', '6', '18'],
            ['40', '6', '27'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `dish`
        $this->dropForeignKey(
            'fk-dish_ingredient-dish_id',
            'dish_ingredient'
        );

        // drops index for column `dish_id`
        $this->dropIndex(
            'idx-dish_ingredient-dish_id',
            'dish_ingredient'
        );

        // drops foreign key for table `ingredient`
        $this->dropForeignKey(
            'fk-dish_ingredient-ingredient_id',
            'dish_ingredient'
        );

        // drops index for column `ingredient_id`
        $this->dropIndex(
            'idx-dish_ingredient-ingredient_id',
            'dish_ingredient'
        );

        $this->dropTable('{{%dish_ingredient}}');
    }
}
