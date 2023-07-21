<?php
declare(strict_types=1);

namespace App\MoneySources;

enum Banknote: int
{
    case BANKNOTE_1 = 1;
    case BANKNOTE_5 = 5;
    case BANKNOTE_10 = 10;
    case BANKNOTE_20 = 20;
    case BANKNOTE_50 = 50;
    case BANKNOTE_100 = 100;

    public function limit(): int
    {
        return match($this) {
            self::BANKNOTE_1 => 5,   
            self::BANKNOTE_5 => 5,   
            self::BANKNOTE_10 => 5,
            self::BANKNOTE_20 => 5,
            self::BANKNOTE_50 => 5,
            self::BANKNOTE_100 => 5,
        };
    }
} 
