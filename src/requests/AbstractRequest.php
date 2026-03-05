<?php

declare(strict_types=1);

namespace app\requests;

use app\services\AbstractDTO;
use yii\base\Model;

/**
 * Абстрактный класс Request
 */
abstract class AbstractRequest extends Model
{
    /**
     * @return AbstractDTO
     */
    abstract public function getDTO(): AbstractDTO;
}
