<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketPriority extends Model
{
    protected $table = 'ticket_priority';

	public $timestamps = false;

	protected $guarded = [];
	
	// Заявки приоритета - связь с моделью Ticket
    public function ticket()
	{
		return $this->belongsTo('App\Ticket', 'ticket_priority_id');
	}
}
