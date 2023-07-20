<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'source' => $this->source_name,
            'amount' => $this->amount,
            'inputs' => $this->inputs,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
