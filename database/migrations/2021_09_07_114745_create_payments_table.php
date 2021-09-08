<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->index();
            $table->integer('amount')->nullable();
            $table->unsignedInteger('subscribe_id')->index();
            $table->string('payment_type');
            $table->boolean('is_invoice')->default(0);
            $table->string('company_name')->nullable();
            $table->string('nip')->nullable();
            $table->string('company_address')->nullable();
            $table->string('payu_id')->nullable();
            $table->string('paypal_id')->nullable();
            $table->integer('status');
            $table->string('token');
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
        Schema::dropIfExists('payments');
    }
}
