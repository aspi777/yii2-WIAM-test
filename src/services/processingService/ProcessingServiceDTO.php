<?php

declare(strict_types=1);

namespace app\services\processingService;

use app\services\AbstractDTO;

class ProcessingServiceDTO extends AbstractDTO
{
    public function __construct(public readonly int $delay)
    {
    }
}
