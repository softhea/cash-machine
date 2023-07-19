<?php
declare(strict_types=1);

namespace App\Models;

use App\Interfaces\Transaction;
use Illuminate\Database\Eloquent\Model;

class CashTransaction extends Model implements Transaction
{
    public const ID = 1;

    public function validate()
    {

    }

    public function amount()
    {
        
    }

    public function inputs()
    {
        
    }
}
