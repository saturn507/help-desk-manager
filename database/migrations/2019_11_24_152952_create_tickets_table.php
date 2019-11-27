<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255)->comment('Назание');
            $table->text('description')->comment('Описание');
            $table->bigInteger('user_id')->nullable()->unsigned()->comment('id пользователя оставившего заявку');
            $table->bigInteger('ticket_type_id')->nullable()->unsigned()->comment('id тип заявки');
            $table->bigInteger('ticket_priority_id')->nullable()->unsigned()->comment('id приоритет заявки');
            $table->bigInteger('ticket_status_id')->nullable()->unsigned()->default(1)->comment('id статус заявки');
            $table->text('comment')->nullable(true)->comment('Коментарий');
            $table->string('session_id',50)->default('')->comment('id сессии редактирующего заявку');
            $table->timestamp('open_time')->useCurrent()->comment('Время открытия заявки');
            $table->time('total_time')->default(0)->comment('Общее время работы с заявкой');
            $table->timestamp('created_at')->useCurrent();
        });
        
		Schema::table('tickets', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('ticket_type_id')->references('id')->on('ticket_type');
            $table->foreign('ticket_priority_id')->references('id')->on('ticket_priority');
            $table->foreign('ticket_status_id')->references('id')->on('ticket_status');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
