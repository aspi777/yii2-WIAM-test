<?php

declare(strict_types=1);

namespace app\services\createLoanService;

use app\enum\ApproveStatusEnum;
use app\models\LoanAR;
use app\services\AbstractDTO;
use app\services\ServiceInterface;
use yii\db\Exception;

/**
 * Создание заявки
 */
class CreateLoanService implements ServiceInterface
{
    /**
     * @param AbstractDTO|CreateLoanServiceDTO $dto
     * @return LoanAR
     * @throws Exception
     */
    public function run(AbstractDTO|CreateLoanServiceDTO $dto): LoanAR
    {
        $newLoan = new LoanAR();
        $newLoan->user_id = $dto->userId;
        $newLoan->amount = $dto->amount;
        $newLoan->term = $dto->term;
        $newLoan->approve_status = ApproveStatusEnum::PENDING->value;

        $newLoan->save();

        return $newLoan;
    }
}
