<?php

use App\Models\ClassTransaction;
use App\Models\Shift;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_transaction_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(ClassTransaction::class)->constrained();
            $table->foreignIdFor(Shift::class)->constrained();
            $table->text('note');
            $table->integer('session');
            $table->date('transaction_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_transaction_details');
    }
}
