<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ingredient`.
 */
class m170709_194700_create_ingredient_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%ingredient}}', [
            'id' => $this->primaryKey(),
            'name_ingredient' => $this->string(75),
            'status' => $this->smallInteger(1)->defaultValue(1),
        ]);

        $this->batchInsert('{{%ingredient}}', ['id', 'name_ingredient', 'status'], [
            ['1', 'Копченая говядина', '1'],
            ['2', 'Соль', '1'],
            ['3', 'Яйца', '1'],
            ['4', 'Помидора', '1'],
            ['5', 'Лук (зелень)', '1'],
            ['6', 'Чеснок', '1'],
            ['7', 'Майонез', '1'],
            ['8', 'Свинина', '1'],
            ['9', 'Лук (репка)', '1'],
            ['10', 'Сыр', '1'],
            ['11', 'Сахар', '1'],
            ['12', 'Морковь', '1'],
            ['13', 'Уксус', '1'],
            ['14', 'Перец', '1'],
            ['15', 'Филе куриное', '1'],
            ['16', 'Укроп', '1'],
            ['17', 'Морковь (по-корейски)', '1'],
            ['18', 'Картофель', '1'],
            ['19', 'Сметана', '0'],
            ['20', 'Зелень', '1'],
            ['21', 'Ягоды', '1'],
            ['22', 'Сельдь', '1'],
            ['23', 'Семга', '0'],
            ['24', 'Свекла', '1'],
            ['25', 'Желатин', '1'],
            ['26', 'Минтай', '1'],
            ['27', 'Консервы рыбные', '1'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%ingredient}');
    }
}
