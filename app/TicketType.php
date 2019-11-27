<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected $table = 'ticket_type';

	public $timestamps = false;

	protected $guarded = [];
	
	// Заявки тип - связь с моделью Ticket
    public function ticket()
	{
		return $this->belongsTo('App\Ticket', 'ticket_type_id');
	}
}
