<?php
declare(strict_types=1);

namespace App\Interfaces;

interface Transaction
{
    public function validate();
    public function amount();
    public function inputs();
}
