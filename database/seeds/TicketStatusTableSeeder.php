<?php

use Illuminate\Database\Seeder;

class TicketStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataList = [
			['name' => 'Новая'],
			['name' => 'В работе'],
			['name' => 'Выполнена'],
			['name' => 'Отложена'],
			['name' => 'Решена'],
		];
		
		foreach ($dataList as $data) {
			DB::table('ticket_status')
				->updateOrInsert(
					[ 'name' => $data['name']  ],
					[ 'name' => $data['name'] ]
				);
		}
    }
}
