<?php

declare(strict_types=1);

namespace app\controllers;

use app\requests\CreateLoanRequest;
use app\responses\SuccessResponse;
use app\responses\ValidationFailedResponse;
use app\services\createLoanService\CreateLoanService;
use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\rest\Controller;

/**
 * Контроллер создания заяви
 */
class LoanController extends Controller
{
    /**
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function actionCreate(
        CreateLoanService $service
    ): ValidationFailedResponse|SuccessResponse {
        $requestModel = new CreateLoanRequest();
        $requestModel->setAttributes($this->request->getBodyParams());

        if (!$requestModel->validate()) {
            return new ValidationFailedResponse();
        }

        $serviceDTO = $requestModel->getDTO();

        $loan = $service->run($serviceDTO);

        return new SuccessResponse(['id' => $loan->id], 201);
    }
}
