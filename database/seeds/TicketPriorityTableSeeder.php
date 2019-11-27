<?php

use Illuminate\Database\Seeder;

class TicketPriorityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataList = [
			['name' => 'Низкий'],
			['name' => 'Средний'],
			['name' => 'Высокий'],
		];
		
		foreach ($dataList as $data) {
			DB::table('ticket_priority')
				->updateOrInsert(
					[ 'name' => $data['name']  ],
					[ 'name' => $data['name'] ]
				);
		}
    }
}
//php artisan db:seed --class=TicketPriorityTableSeeder