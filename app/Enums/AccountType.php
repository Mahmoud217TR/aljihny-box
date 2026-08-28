<?php

namespace App\Enums;

enum AccountType: string
{
    case CreditNormal = 'credit_normal';
    case DebitNormal = 'debit_normal';
}
