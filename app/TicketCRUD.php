<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Session;
use App\User;
use App\Ticket;
use App\Http\Helpers\GenUserData;


class TicketCRUD extends Model
{	
	/**
     * Создание новой заявки
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function newTicket($request){
    	
    	$user = User::find($request->id);
    	// Если пользователя с id нет, то создать его с сгенерированными данными (Имя, email, телефон)
    	if(!$user){
    		$data = [
				'id'       => $request->id,
				'name'     => GenUserData::genName(),
				'email'    => GenUserData::genEmail(),
				'phone'    => GenUserData::genPhone(),
				'password' => '',	
			];
			
			User::create($data);
		}
		
		$data = [
			'name'               => $request->title,
			'description'        => $request->description,
			'user_id'            => $request->id,
			'ticket_type_id'     => $request->type,
			'ticket_priority_id' => $request->priority,	
			'comment'            => '',		
		];
		
		$ticket = Ticket::create($data);
		
		if($ticket){
			return $ticket->id;
		}
		else{
			return false;
		}  	
	}
	
	/**
     * Вывести все заявки по фильтру
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
	public function getAllTickets($request)
	{
		$t = Ticket::select(['tickets.*','ticket_priority.name as priorityName','ticket_status.name as statusName',
									'ticket_type.name as typeName','users.name as userName'])
						->leftJoin('ticket_priority','ticket_priority.id','=','tickets.ticket_priority_id')
						->leftJoin('ticket_status','ticket_status.id','=','tickets.ticket_status_id')
						->leftJoin('ticket_type','ticket_type.id','=','tickets.ticket_type_id')
						->leftJoin('users','users.id','=','tickets.user_id');
		
		//Записать фильтры в сессию
		if(!empty($request->filter)){
			if($request->resetFilter){
				Session::put('priority', 0);			
				Session::put('status', 0);
				Session::put('type', 0);
			}
			else{
				Session::put('priority', $request->priority);			
				Session::put('status', $request->status);
				Session::put('type', $request->type);
			}
		}
		// Применить фильтры
		if(Session::get('priority') > 0){
			$t->where('tickets.ticket_priority_id',Session::get('priority'));
		}
		
		if(Session::get('status') > 0){
			$t->where('tickets.ticket_status_id',Session::get('status'));
		}
		
		if(Session::get('type') > 0){
			$t->where('tickets.ticket_type_id',Session::get('type'));
		}
		
		$t->orderBy('created_at', 'desc');
		$tickets = $t->get();
		
		if($tickets){
			$data = [];
			foreach($tickets as $val){
				$data[] = [
					'id'             => $val->id,
					'name'           => $val->name,
					'userName'       => $val->userName,
					'ticketType'     => $val->typeName,
					'ticketPriority' => $val->priorityName,
					'ticketStatus'   => $val->statusName,
					'date'           => date('d.m.Y H:i',strtotime($val->created_at)),
					'totalTime'      => $val->total_time,
					'edit'           => $val->session_id,
				];
			}
			return $data;
		}
		else{
			return false;
		}
	}
	
	/**
     * Вывести одну заявку по id
     *
     * @param  $id int
     * @return mixed
     */
	public function getTicket($id){
		$ticket = Ticket::find($id);
		if($ticket){
			$data = [
				'id'             => $ticket->id,
				'name'           => $ticket->name,
				'description'    => $ticket->description,
				'comment'        => $ticket->comment,
				'userName'       => $ticket->user->name,
				'userPhone'      => $ticket->user->phone,
				'userEmail'      => $ticket->user->email,
				'ticketType'     => $ticket->type->name,
				'ticketPriority' => $ticket->priority->name,
				'ticketStatusId' => $ticket->status->id,
				'date'           => date('d.m.Y H:i',strtotime($ticket->created_at)),
				'totalTime'      => $ticket->total_time,
				'edit'           => '',
			];
			
			//Проверить - заявка редактируется в данный момент
			if($ticket->session_id != ''){
				$data['edit'] = $ticket->session_id != Session::getId() ? $ticket->session_id : ''; 
			}
			else{
				$ticket->session_id = Session::getId();
				$ticket->open_time = now();
				$ticket->save();
			}			
			return $data;
		}
		else{
			return false;
		}
	}
	
	/**
     * Изменение заявки
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
	public function updateTicket($request)
	{
		$ticket = Ticket::find($request->ticketId);
		$ticket->session_id = '';
		//Общее время нахождения заявки в работе
		$newTotalTime = date('H:i:s',strtotime($ticket->total_time) + strtotime(date("H:i:s",mktime(0, 0, time() - strtotime($ticket->open_time)))) -strtotime("00:00:00"));
		$ticket->total_time = $newTotalTime;
		$ticket->comment = $request->comment;
		$ticket->ticket_status_id = $request->status;
		return $ticket->save();
	}
}
