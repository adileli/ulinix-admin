<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pid')->default(0)->comment('父id');
            $table->string('title_ug', 100)->comment('维吾尔名称');
            $table->string('title_cn', 100)->comment('中文名称');
            $table->string('icon', 100)->comment('图标');
            $table->string('href', 100)->comment('连接');
            $table->string('target', 20)->default('_self')->comment('打开方式');
            $table->integer('sort')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态(0:禁用,1:启用)');
            $table->string('remark', 255)->nullable()->comment('备注信息');
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
        Schema::dropIfExists('admin_menus');
    }
}
