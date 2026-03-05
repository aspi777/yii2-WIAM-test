<?php

declare(strict_types=1);

use app\models\UserAR;
use yii\db\Migration;

/**
 * Создание таблицы users
 */
class m260304_044657_create_table_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(UserAR::tableName(), [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $this->batchInsert(
            UserAR::tableName(),
            ['id', 'name'],
            $this->getUsers()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(UserAR::tableName());
    }

    /**
     * @return array
     */
    private function getUsers(): array
    {
        return [
            [1, 'User 1'],
            [2, 'User 2'],
            [3, 'User 3'],
            [4, 'User 4'],
            [5, 'User 5'],
        ];
    }
}
