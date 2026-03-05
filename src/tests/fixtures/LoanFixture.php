<?php

declare(strict_types=1);

namespace app\tests\fixtures;

use app\models\LoanAR;
use yii\test\ActiveFixture;

class LoanFixture extends ActiveFixture
{
    public $modelClass = LoanAR::class;

    public $dataFile = '@app/tests/fixtures/data/loans.php';
}
