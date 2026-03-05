<?php

declare(strict_types=1);

use app\enum\ApproveStatusEnum;

return [
    [
        'user_id' => 3,
        'amount' => 4,
        'term' => 2,
        'approve_status' => ApproveStatusEnum::APPROVED->value,
    ],
    [
        'id' => 42,
        'user_id' => 2,
        'amount' => 50,
        'term' => 23,
        'approve_status' => ApproveStatusEnum::PENDING->value,
    ],
];
