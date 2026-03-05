<?php

declare(strict_types=1);

namespace functional;

use app\jobs\SaveLoanApproveDecisionJob;
use app\models\LoanAR;
use app\tests\fixtures\LoanFixture;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use FunctionalTester;
use Yii;

/**
 * Тест Job сохранения результата по заявке
 */
class SaveLoanApproveDecisionJobCest
{
    /**
     * @return array[]
     */
    public function _fixtures(): array
    {
        return [
            'loans' => [
                'class' => LoanFixture::class,
            ],
        ];
    }

    /**
     * @param FunctionalTester $tester
     * @param Example $example
     * @return void
     */
    #[DataProvider('dataProvider')]
    public function jobTest(FunctionalTester $tester, Example $example): void
    {
        $job = new SaveLoanApproveDecisionJob(
            loanId: $example['loanId'],
            isApproved: $example['isApproved'],
        );

        Yii::$app->queue->push($job);
        Yii::$app->queue->run();

        $tester->seeRecord(LoanAR::class, [
            'id' => $example['loanId'],
            'approve_status' => $example['approveStatus'],
        ]);
    }

    /**
     * @return array[]
     */
    private function dataProvider(): array
    {
        return [
            'approved' => [
                'loanId' => 42,
                'isApproved' => true,
                'approveStatus' => 'approved',
            ],
            'declined' => [
                'loanId' => 42,
                'isApproved' => false,
                'approveStatus' => 'declined',
            ],
        ];
    }
}
