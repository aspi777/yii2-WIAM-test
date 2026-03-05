<?php

declare(strict_types=1);

namespace app\jobs;

use app\enum\ApproveStatusEnum;
use app\models\LoanAR;
use yii\base\BaseObject;
use yii\db\Exception;
use yii\queue\JobInterface;

/**
 * Job сохранение статуса согласования займа
 */
class SaveLoanApproveDecisionJob extends BaseObject implements JobInterface
{
    /**
     * @param int $loanId
     * @param bool $isApproved
     */
    public function __construct(
        private readonly int $loanId,
        private readonly bool $isApproved,
    ) {
        parent::__construct();
    }

    /**
     * @param $queue
     * @return void
     * @throws Exception
     */
    public function execute($queue): void
    {
        $loan = LoanAR::findOne(['id' => $this->loanId]);
        if ($loan->approve_status !== ApproveStatusEnum::PENDING->value) {
            return;
        }

        $loan->approve_status = match ($this->isApproved) {
            true => ApproveStatusEnum::APPROVED->value,
            false => ApproveStatusEnum::DECLINED->value,
        };

        $loan->save();
    }
}
