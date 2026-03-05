<?php

declare(strict_types=1);

namespace api;

use ApiTester;
use app\tests\fixtures\LoanFixture;

/**
 * API тест эндпойнта запуска одобрения заявок
 */
class ProcessingRunCest
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
     * @param ApiTester $I
     * @return void
     */
    public function processingRun(ApiTester $I): void
    {
        $I->wantTo('Проверка запуска процесса одобрения заявок');

        $I->sendGet('processor', ['delay' => 1]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'result' => true,
        ]);
    }

    /**
     * @param ApiTester $I
     * @return void
     */
    public function processingWithoutDelay(ApiTester $I): void
    {
        $I->wantTo('Проверка запуска процесса одобрения заявок без указания delay');

        $I->sendGet('processor');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'result' => false,
        ]);
    }
}
