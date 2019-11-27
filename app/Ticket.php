<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

	public $timestamps = false;

	protected $guarded = [];
	
	// Приоритет заявки - связь с моделью TicketPriority
	public function priority()
	{
		return $this->belongsTo('App\TicketPriority','ticket_priority_id');
	}
	
	// Статус заявки - - связь с моделью TicketPriority
	public function status()
	{
		return $this->belongsTo('App\TicketStatus','ticket_status_id');
	}
	
	// Тип заявки - - связь с моделью TicketType
	public function type()
	{
		return $this->belongsTo('App\TicketType','ticket_type_id');
	}
	
	// Пользователь разместивший заявку - связь с моделью User
	public function user()
	{
		return $this->belongsTo('App\User','user_id');
	}
}
