<?php

declare(strict_types=1);

namespace app\responses;

use Yii;
use yii\web\Response;

abstract class AbstractResponse
{
    /**
     * @param array $data
     * @param bool $isSuccess
     * @param int $statusCode
     */
    public function __construct(
        protected array $data = [],
        protected bool $isSuccess = true,
        protected int $statusCode = 200,
    ) {
        $this->send();
    }

    /**
     * @return void
     */
    private function send(): void
    {

        $this->data = array_merge(['result' => $this->isSuccess], $this->data);
        Yii::$app->response->statusCode = $this->statusCode;
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->response->data = $this->data;

        Yii::$app->response->send();
    }
}
