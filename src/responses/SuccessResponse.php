<?php

declare(strict_types=1);

namespace app\responses;

/**
 * Response для успешного ответа
 */
class SuccessResponse extends AbstractResponse
{
    /**
     * @param array $data
     * @param int $statusCode
     */
    public function __construct(protected array $data = [], int $statusCode = 200)
    {
        parent::__construct($this->data, true, $statusCode);
    }
}
