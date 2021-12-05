<?php

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvalusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evalus', function (Blueprint $table) {
            $table->primary(['user_id','event_id']);
            $table->integer('qte');
            $table->timestamps();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Event::class);
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evalus');
    }
}
