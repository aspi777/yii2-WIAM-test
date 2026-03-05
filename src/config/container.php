<?php

declare(strict_types=1);

use app\services\createLoanService\CreateLoanService;
use app\services\processingService\ProcessingService;

return [
    'definitions' => [
        CreateLoanService::class => [],
        ProcessingService::class => [],
    ],
];
