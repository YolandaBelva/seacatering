<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->date('pause_from')->nullable();
            $table->date('pause_until')->nullable();
        });
    }

    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn(['pause_from', 'pause_until']);
        });
    }
};
