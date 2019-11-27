<?php

use Illuminate\Database\Seeder;

class TicketTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataList = [
			['name' => 'Сервисное обслуживание'],
			['name' => 'Поддержка'],
			['name' => 'Запрос технической информации'],
		];
		
		foreach ($dataList as $data) {
			DB::table('ticket_type')
				->updateOrInsert(
					[ 'name' => $data['name']  ],
					[ 'name' => $data['name'] ]
				);
		}
    }
}
