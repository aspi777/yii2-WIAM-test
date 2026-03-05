<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Модель User
 *
 * @property int $id
 * @property LoanAR[] $loans
 */
class UserAR extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%users}}';
    }

    /**
     * @return ActiveQuery
     */
    public function getLoans(): ActiveQuery
    {
        return $this->hasMany(LoanAR::class, ['user_id' => 'id']);
    }
}
