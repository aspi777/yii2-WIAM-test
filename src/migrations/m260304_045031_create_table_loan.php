<?php

declare(strict_types=1);

use app\enum\ApproveStatusEnum;
use app\models\LoanAR;
use app\models\UserAR;
use yii\db\Migration;

class m260304_045031_create_table_loan extends Migration
{
    private const string TYPE_NAME = 'status_type';

    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->execute("DROP TYPE IF EXISTS " . self::TYPE_NAME);
        $sql = "CREATE TYPE " . self::TYPE_NAME . " AS ENUM ('"
            . ApproveStatusEnum::PENDING->value . "', '"
            . ApproveStatusEnum::APPROVED->value . "', '"
            . ApproveStatusEnum::DECLINED->value. "');";
        $this->execute($sql);

        $this->createTable(LoanAR::tableName(), [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->unsigned()->notNull(),
            'amount' => $this->integer()->unsigned()->notNull(),
            'term' => $this->integer()->unsigned()->notNull(),
            'approve_status' => self::TYPE_NAME . " DEFAULT '" . ApproveStatusEnum::PENDING->value . "'",
        ]);

        $this->addForeignKey(
            'fk_loans_users',
            LoanAR::tableName(),
            'user_id',
            UserAR::tableName(),
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(LoanAR::tableName());
    }
}
