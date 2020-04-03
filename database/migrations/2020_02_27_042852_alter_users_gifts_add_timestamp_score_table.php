<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersGiftsAddTimestampScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('gift_user', 'mark')) {
            Schema::table('gift_user', function (Blueprint $table) {
                $table->boolean('mark');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('gift_user', 'mark')) {
            Schema::table('gift_user', function (Blueprint $table) {
                $table->dropColumn('mark');
                $table->dropColumn('created_at');
                $table->dropColumn('updated_at');
            });
        }
    }
}
