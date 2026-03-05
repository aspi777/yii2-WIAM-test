<?php

declare(strict_types=1);

namespace app\tests\api;

use ApiTester;
use app\models\LoanAR;
use app\tests\fixtures\LoanFixture;
use Codeception\Attribute\DataProvider;
use Codeception\Example;

/**
 * API тест создания заявки на займ
 */
class CreateLoanCest
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
     * @param Example $example
     * @return void
     */
    #[DataProvider('dataProvider')]
    public function createLoan(ApiTester $I, Example $example): void
    {
        $I->wantTo('Проверка создания заявки на займ');

        $I->sendPost('requests', $example['params']);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'result' => 'boolean',
            'id' => 'integer',
        ]);
        $I->seeResponseContainsJson([
            'result' => true,
        ]);
        $I->seeRecord(LoanAR::class, $example['params']);
    }

    /**
     * @param ApiTester $I
     * @param Example $example
     * @return void
     */
    #[DataProvider('dataProvider')]
    public function createWithEmptyAmountError(ApiTester $I, Example $example): void
    {
        $I->wantTo('Проверка создания заявки на займ с ошибкой валидации значения amount');
        $params = $example['params'];
        unset($params['amount']);

        $I->sendPost('requests', $params);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'result' => false,
        ]);
    }

    /**
     * @param ApiTester $I
     * @param Example $example
     * @return void
     */
    #[DataProvider('dataProvider')]
    public function createWithUserHasApprovedError(ApiTester $I, Example $example): void
    {
        $I->wantTo('Проверка создания заявки на займ с user_id у которого уже есть approved заявка');
        $params = $example['params'];
        $params['user_id'] = 3;

        $I->sendPost('requests', $params);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'result' => false,
        ]);
    }

    /**
     * @return array[]
     */
    private function dataProvider(): array
    {
        return [
            [
                'params' => [
                    'user_id' => 2,
                    'amount' => 100,
                    'term' => 42,
                ],
            ],
        ];
    }
}
