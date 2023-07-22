<?php
declare(strict_types=1);

namespace App\MoneySources;

use App\Exceptions\ValidationException;
use App\Requests\TransactionRequest;
use Exception;
use Illuminate\Support\Facades\Validator;

abstract class AbstractTransaction
{
    private int $amount = 0;
    private array $inputs = [];

    public function isCash(): bool
    {
        return false;
    }

    public function processRequest(TransactionRequest $request): void
    {
        $this->amount = $request->getAmount();
        $this->inputs = $request->getInputs();        
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function inputs(): array
    {
        return $this->inputs;
    }

    /**
     * @throws Exception
     */
    public function validate(): void
    {
        if ([] === $this->validationRules()) {
            return;
        }
        
        $validator = Validator::make($this->inputs(), $this->validationRules());
        if ($validator->fails()) {
            throw new ValidationException(
                $validator->errors()->toJson()
            );
        }

        $this->inputs = $validator->validated();
    }

    protected function validationRules(): array
    {
        return [];
    }
}
