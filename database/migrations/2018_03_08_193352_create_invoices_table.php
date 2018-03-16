<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->enum('status', ['Created', 'Pending', 'Paid'])->default('Created');

            $table->integer('number');
            $table->integer('year');

            $table->date('issue_date');
            $table->date('billing_date');
            $table->string('currency');
            $table->text('data');
            $table->integer('total');

            $table->string('hash')->default('');
            $table->string('pdf')->default('');

            $table->foreign('user_id', 'fk2_user_data_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('customer_id', 'fk_customer_data_idx')
                ->references('id')->on('customers')
                ->onDelete('no action')
                ->onUpdate('no action');

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
        Schema::dropIfExists('invoices');
    }
}
