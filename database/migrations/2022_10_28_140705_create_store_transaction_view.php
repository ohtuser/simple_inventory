<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStoreTransactionView extends Migration
{

    public function up()
    {
        DB::statement($this->dropView());

        DB::statement($this->createView());
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `store_transaction_view`;
        SQL;
    }

    private function createView(): string
    {
        return <<<SQL
            CREATE VIEW `store_transaction_view` AS
            SELECT product_id, sum(if(in_out=1,quantity,0)) - sum(if(in_out=2,quantity,0)) as avail
            FROM invoice_transactions group by product_id;
        SQL;
    }

    public function down()
    {
        DB::statement($this->dropView());
    }
}
