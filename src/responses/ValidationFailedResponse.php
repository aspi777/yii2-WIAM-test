<?php

declare(strict_types=1);

namespace app\responses;

/**
 * Response для ответа об ошибке валидации
 */
class ValidationFailedResponse extends AbstractResponse
{
    /**
     * @param array $data
     * @param int $statusCode
     */
    public function __construct(protected array $data = [], int $statusCode = 400)
    {
        parent::__construct($this->data, false, $statusCode);
    }
}
