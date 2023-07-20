<?php
declare(strict_types=1);

namespace App\MoneySources;

use App\Exceptions\ValidationException;
use Exception;
use Illuminate\Support\Facades\Validator;

class CardTransaction extends AbstractTransaction implements Transaction
{
    public function sourceId(): int
    {
        return 2;
    }

    public function sourceName(): string
    {
        return 'Credit Card';
    }

    protected function validationRules(): array
    {
        $dateInTwoMonths = (new \DateTime('+2 months'))->format('m/Y');

        return [
            'amount' => 'required|integer|min:1',
            'card_number' => 'required|digits:16|starts_with:4',
            'expiration_date' => 'required|date_format:m/Y|after_or_equal:'.$dateInTwoMonths,
            'cvv' => 'required|digits:3',
            'card_holder' => 'required',
        ];
    }
}
