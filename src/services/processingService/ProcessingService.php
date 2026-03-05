<?php

declare(strict_types=1);

namespace app\services\processingService;

use app\enum\ApproveStatusEnum;
use app\jobs\SaveLoanApproveDecisionJob;
use app\models\LoanAR;
use app\models\UserAR;
use app\services\AbstractDTO;
use app\services\ServiceInterface;
use Yii;

/**
 * Обработка заявок
 */
class ProcessingService implements ServiceInterface
{
    /**
     * @param AbstractDTO|ProcessingServiceDTO $dto
     * @return mixed
     */
    public function run(AbstractDTO|ProcessingServiceDTO $dto): bool
    {
        $subQuery = LoanAR::find()
            ->select(['id'])
            ->where('loans.user_id = users.id')
            ->andWhere(['loans.approve_status' => ApproveStatusEnum::APPROVED->value]);
        $users = UserAR::find()
            ->where(['not exists', $subQuery])
            ->all();

        $userIdList = array_column($users, 'id');

        $pendingLoans = LoanAR::find()
            ->where(['user_id' => $userIdList])
            ->andWhere(['approve_status' => ApproveStatusEnum::PENDING->value])
            ->all();

        foreach ($pendingLoans as $loan) {
            // имитация времени обработки заявки
            sleep($dto->delay);

            $isApproved = rand(1, 100) <= 10;
            $job = new SaveLoanApproveDecisionJob(
                loanId: $loan->id,
                isApproved: $isApproved,
            );

            Yii::$app->queue->push($job);
        }

        return true;
    }
}
