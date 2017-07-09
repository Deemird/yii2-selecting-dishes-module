<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dish`.
 */
class m170709_194641_create_dish_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%dish}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(125)->notNull()->unique(),
        ]);

        $this->batchInsert('{{%dish}}', ['id', 'name'], [
            ['1', 'Салат "Вдохновение"'],
            ['2', 'Салат "Купеческий"'],
            ['3', 'Салат "Бунито"',],
            ['4', 'Салат "Сельдь под шубой"'],
            ['5', 'Салат "Раковые шейки"'],
            ['6', 'Салат "Мимоза"'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%dish}}');
    }
}
