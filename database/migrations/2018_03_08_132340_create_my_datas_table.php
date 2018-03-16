<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_datas', function (Blueprint $table) {

            $table->integer('user_id')->unique()->unsigned();

            $table->string('name');
            $table->string('sufix');
            $table->string('owner');
            $table->string('vat');
            $table->string('street');
            $table->string('city');
            $table->string('zip',10);
            $table->string('country');

            $table->string('iban');
            $table->string('bank');

            $table->foreign('user_id', 'fk_user_data_idx')
                ->references('id')->on('users')
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
        Schema::dropIfExists('my_datas');
    }
}
