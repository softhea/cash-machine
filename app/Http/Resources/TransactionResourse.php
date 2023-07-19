<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResourse extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'source' => 'CashTransaction',
            'amount' => $this->amount,
            'inputs' => $this->inputs,
            'created_at' => $this->created_at,
        ];
    }
}
