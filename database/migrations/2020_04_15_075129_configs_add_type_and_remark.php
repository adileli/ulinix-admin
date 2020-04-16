<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConfigsAddTypeAndRemark extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->string('title_ug')->default('')->comment('维语标题')->after('value');
            $table->string('title_cn')->default('')->comment('中文标题')->after('title_ug');
           $table->string('type')->default('system')->comment('类型')->after('id');
           $table->string('remark')->nullable()->comment('备注')->after('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configs', function (Blueprint $table) {
           $table->dropColumn('title_ug', 'title_cn', 'type', 'remark');
        });
    }
}
