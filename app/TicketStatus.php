<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    protected $table = 'ticket_status';

	public $timestamps = false;

	protected $guarded = [];
	
	// Заявки в статусе  - связь с моделью Ticket
    public function ticket()
	{
		return $this->belongsTo('App\Ticket', 'ticket_status_id');
	}
}
