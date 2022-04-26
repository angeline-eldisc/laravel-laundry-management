<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_code');
            $table->foreignId('member_id')->constrained();
            $table->dateTime('date');
            $table->date('due_date');
            $table->date('payment_date')->nullable();
            $table->integer('additional_cost');
            $table->double('discount');
            $table->integer('tax');
            $table->enum('status', ['New', 'Process', 'Pick Up', 'Done']);
            $table->enum('paid_status', ['Paid', 'Not yet paid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
