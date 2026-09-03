<?php

namespace Database\Seeders;

use App\Actions\Account\CreateAccountAction;
use App\Data\Account\CreateAccountData;
use App\Enums\AccountCategory;
use App\Enums\AccountType;
use App\Enums\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductionSeeder extends Seeder
{
    public function __construct(
        private readonly CreateAccountAction $create,
    ) {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function ()  {
            $this->createAssetsAccounts();
            $this->createLiabilitiesAccounts();
            $this->createEquityAccounts();
            $this->createRevenueAccounts();
            $this->createExpensesAccounts();
        });
    }

    private function createAssetsAccounts()
    {
        $assetsAccount = $this->create->execute(
            new CreateAccountData(
                1000,
                __('Assets'),
                AccountType::DebitNormal,
                AccountCategory::Assets,
                null,
                false,
            ),
        );

        $cashAccount = $this->create->execute(
            new CreateAccountData(
                1100,
                __('Cash'),
                AccountType::DebitNormal,
                AccountCategory::Assets,
                null,
                false,
            ),
            $assetsAccount
        );

        $this->create->execute(
            new CreateAccountData(
                1110,
                __('Main SYP Cash Box'),
                AccountType::DebitNormal,
                AccountCategory::Assets,
                Currency::SYP,
                true,
            ),
            $cashAccount
        );

        $this->create->execute(
            new CreateAccountData(
                1200,
                __('USD Reserve'),
                AccountType::DebitNormal,
                AccountCategory::Assets,
                Currency::USD,
                true,
            ),
            $assetsAccount
        );

        $accountsReceivable = $this->create->execute(
            new CreateAccountData(
                1300,
                __('Accounts Receivable'),
                AccountType::DebitNormal,
                AccountCategory::Assets,
                null,
                false,
            ),
            $assetsAccount
        );

        $this->create->execute(
            new CreateAccountData(
                1310,
                __('Member Fees Receivable'),
                AccountType::DebitNormal,
                AccountCategory::Assets,
                Currency::SYP,
                true,
            ),
            $accountsReceivable
        );
    }

    private function createLiabilitiesAccounts()
    {
        $liabilitiesAccount = $this->create->execute(
            new CreateAccountData(
                2000,
                __('Liabilities'),
                AccountType::CreditNormal,
                AccountCategory::Liabilities,
                null,
                false,
            ),
        );

        $this->create->execute(
            new CreateAccountData(
                2100,
                __('Member Prepayments'),
                AccountType::CreditNormal,
                AccountCategory::Liabilities,
                Currency::SYP,
                true,
            ),
            $liabilitiesAccount
        );
    }

    private function createEquityAccounts()
    {
        $equityAccount = $this->create->execute(
            new CreateAccountData(
                3000,
                __('Equity'),
                AccountType::CreditNormal,
                AccountCategory::Equity,
                null,
                false,
            ),
        );

        $this->create->execute(
            new CreateAccountData(
                3100,
                __('Fund Balance'),
                AccountType::CreditNormal,
                AccountCategory::Equity,
                Currency::SYP,
                true,
            ),
            $equityAccount
        );
    }

    private function createRevenueAccounts()
    {
        $revenueAccount = $this->create->execute(
            new CreateAccountData(
                4000,
                __('Revenue'),
                AccountType::CreditNormal,
                AccountCategory::Revenue,
                null,
                false,
            ),
        );

        $this->create->execute(
            new CreateAccountData(
                4100,
                __('Membership Fees'),
                AccountType::CreditNormal,
                AccountCategory::Revenue,
                Currency::SYP,
                true,
            ),
            $revenueAccount
        );

        $this->create->execute(
            new CreateAccountData(
                4200,
                __('Donations'),
                AccountType::CreditNormal,
                AccountCategory::Revenue,
                Currency::SYP,
                true,
            ),
            $revenueAccount
        );


        $this->create->execute(
            new CreateAccountData(
                4300,
                __('Other Revenue'),
                AccountType::CreditNormal,
                AccountCategory::Revenue,
                Currency::SYP,
                true,
            ),
            $revenueAccount
        );

        $this->create->execute(
            new CreateAccountData(
                4400,
                __('FX Gain'),
                AccountType::CreditNormal,
                AccountCategory::Revenue,
                Currency::SYP,
                true,
            ),
            $revenueAccount
        );
    }

    private function createExpensesAccounts()
    {
        $expensesAccount = $this->create->execute(
            new CreateAccountData(
                5000,
                __('Expenses'),
                AccountType::DebitNormal,
                AccountCategory::Expenses,
                null,
                false,
            ),
        );

        $this->create->execute(
            new CreateAccountData(
                5100,
                __('Member Assistance'),
                AccountType::DebitNormal,
                AccountCategory::Expenses,
                Currency::SYP,
                true,
            ),
            $expensesAccount
        );

        $this->create->execute(
            new CreateAccountData(
                5200,
                __('Other Expenses'),
                AccountType::DebitNormal,
                AccountCategory::Expenses,
                Currency::SYP,
                true,
            ),
            $expensesAccount
        );

        $this->create->execute(
            new CreateAccountData(
                5300,
                __('FX Loss'),
                AccountType::DebitNormal,
                AccountCategory::Expenses,
                Currency::SYP,
                true,
            ),
            $expensesAccount
        );
    }
}
