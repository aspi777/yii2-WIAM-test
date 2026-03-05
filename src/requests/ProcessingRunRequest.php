<?php

declare(strict_types=1);

namespace app\requests;

use app\requests\AbstractRequest;
use app\services\AbstractDTO;
use app\services\processingService\ProcessingServiceDTO;

/**
 * Request запуска обработки заявок
 */
class ProcessingRunRequest extends AbstractRequest
{
    public ?int $delay = null;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['delay', 'integer', 'min' => 1, 'max' => 100],
            ['delay', 'required'],
        ];
    }

    /**
     * @return ProcessingServiceDTO
     */
    public function getDTO(): ProcessingServiceDTO
    {
        return new ProcessingServiceDTO(delay: $this->delay);
    }
}
