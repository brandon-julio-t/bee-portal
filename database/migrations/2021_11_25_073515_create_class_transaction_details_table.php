<?php

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
            $table->foreignUuid('class_transaction_id')->constrained();
            $table->foreignUuid('shift_id')->constrained();
            $table->text('note');
            $table->integer('session');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('finish_at')->nullable();
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
