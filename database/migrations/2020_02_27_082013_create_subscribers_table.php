<?php

use App\Models\Subscriber;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\User;



class CreateSubscribersTable extends Migration
{

    public function up()
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->string('name');
            $table->string('state')->default(Subscriber::STATE_UNCONFIRMED);
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
        Schema::dropIfExists('subscribers');
    }
}
