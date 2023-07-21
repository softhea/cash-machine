<?php
declare(strict_types=1);

namespace App\MoneySources;

use App\Models\Transaction as TransactionModel;
use Exception;

class CashTransaction extends AbstractTransaction implements Transaction
{
    public const LIMIT = 10000;

    private array $banknotes = [];

    public function sourceId(): int
    {
        return 1;
    }

    public function sourceName(): string
    {
        return 'Cash';
    }
    
    public function isCash(): bool
    {
        return true;
    }

    /**
     * @throws Exception
     */
    public function validate(): void
    {
        parent::validate();

        foreach ($this->inputs()['banknotes'] as $banknote) {
            $this->validateQuantities($banknote);
        }

        $this->validateCashAmount();
    }

    protected function validationRules(): array
    {
        return [
            'banknotes' => 'required|array|min:1',
            'banknotes.*' => [
                'required',
                'in:'.implode(',', array_column(Banknote::cases(), 'value')),
            ],
        ];
    }

    /**
     * @throws Exception
     */
    private function validateQuantities(int|string $banknoteValue): void
    {
        $banknote = Banknote::tryFrom((int)$banknoteValue);
        
        if (!array_key_exists($banknoteValue, $this->banknotes)) {
            $this->banknotes[$banknoteValue] = 0;
        }
        $this->banknotes[$banknoteValue]++;

        if ($banknote->limit() < $this->banknotes[$banknoteValue]) {
            throw new Exception(
                'Maximum Quantity of Banknote '.$banknoteValue.' per Transaction is: '.$banknote->limit()
            );
        }
    }

    /**
     * @throws Exception
     */
    private function validateCashAmount(): void
    {
        if ($this->getTotalCashAmount() + $this->amount() > self::LIMIT) {
            throw new Exception(
                'Maximum Amount for Total Cash Processing would be reached!'
            );
        }
    }

    private function getTotalCashAmount(): int
    {
        return (int)TransactionModel::query()
            ->where('is_cache', true)
            ->sum('amount');
    }
}
