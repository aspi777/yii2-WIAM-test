<?php

declare(strict_types=1);

namespace app\services\createLoanService;

use app\services\AbstractDTO;

class CreateLoanServiceDTO extends AbstractDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly int $amount,
        public readonly int $term,
    ) {
    }
}
