<?php

namespace app\services;

interface ServiceInterface
{
    /**
     * @param AbstractDTO $dto
     * @return mixed
     */
    public function run(AbstractDTO $dto): mixed;
}
