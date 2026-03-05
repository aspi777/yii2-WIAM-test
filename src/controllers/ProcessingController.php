<?php

declare(strict_types=1);

namespace app\controllers;

use app\requests\ProcessingRunRequest;
use app\responses\SuccessResponse;
use app\responses\ValidationFailedResponse;
use app\services\processingService\ProcessingService;
use yii\rest\Controller;

/**
 * Контроллер обработки заявок на займы
 */
class ProcessingController extends Controller
{
    /**
     * @param ProcessingService $service
     * @return ValidationFailedResponse|SuccessResponse
     */
    public function actionRun(
        ProcessingService $service
    ): ValidationFailedResponse|SuccessResponse {
        $requestModel = new ProcessingRunRequest();
        $requestModel->setAttributes($this->request->getQueryParams());

        if (!$requestModel->validate()) {
            return new ValidationFailedResponse();
        }

        $serviceDTO = $requestModel->getDTO();
        $service->run($serviceDTO);

        return new SuccessResponse();
    }
}
