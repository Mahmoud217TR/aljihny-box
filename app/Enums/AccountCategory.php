<?php

namespace App\Enums;

enum AccountCategory: string
{
    case Assets = 'assets';
    case Liabilities = 'liabilities';
    case Equity = 'rquity';
    case Revenue = 'revenue';
    case Expenses = 'expenses';
}
