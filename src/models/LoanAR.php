<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель заявки на займ
 *
 * @property int $id
 * @property int $user_id
 * @property int $amount
 * @property int $term
 * @property string $approve_status
 */
class LoanAR extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%loans}}';
    }
}
