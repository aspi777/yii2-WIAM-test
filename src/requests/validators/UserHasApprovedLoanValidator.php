<?php

declare(strict_types=1);

namespace app\requests\validators;

use app\enum\ApproveStatusEnum;
use app\models\LoanAR;
use yii\validators\Validator;

/**
 * Валидатор для проверки
 */
class UserHasApprovedLoanValidator extends Validator
{
    /**
     * @param $model
     * @param $attribute
     * @return void
     */
    public function validateAttribute($model, $attribute): void
    {
        $userId = $model->$attribute;
        $approvedLoan = LoanAR::findOne([
            'user_id' => $userId,
            'approve_status' => ApproveStatusEnum::APPROVED->value,
        ]);
        if (!empty($approvedLoan)) {
            $this->addError($model, $attribute, 'Пользователь уже имеет одобренный займ');
        }
    }
}
