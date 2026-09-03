<?php

namespace App\Enums;

enum AccountCategory: string
{
    case Assets = 'assets';
    case Liabilities = 'liabilities';
    case Equity = 'equity';
    case Revenue = 'revenue';
    case Expenses = 'expenses';
}
