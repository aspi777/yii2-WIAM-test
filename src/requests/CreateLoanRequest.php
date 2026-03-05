<?php

declare(strict_types=1);

namespace app\requests;

use app\models\UserAR;
use app\requests\validators\UserHasApprovedLoanValidator;
use app\services\AbstractDTO;
use app\services\createLoanService\CreateLoanServiceDTO;

/**
 * Request для создания заявки
 */
class CreateLoanRequest extends AbstractRequest
{
    public ?int $user_id = null;
    public ?int $amount = null;
    public ?int $term = null;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['user_id', 'amount', 'term'], 'required'],
            [
                'user_id',
                'exist',
                'targetClass' => UserAR::class,
                'targetAttribute' => 'id',
            ],
            ['user_id', UserHasApprovedLoanValidator::class],
            ['amount', 'integer', 'min' => 1, 'max' => 10_000_000],
            ['term', 'integer', 'min' => 1, 'max' => 365],
        ];
    }

    /**
     * @return CreateLoanServiceDTO
     */
    public function getDTO(): CreateLoanServiceDTO
    {
        return new CreateLoanServiceDTO(
            userId: $this->user_id,
            amount: $this->amount,
            term: $this->term,
        );
    }
}
