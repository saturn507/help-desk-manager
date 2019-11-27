<?php

namespace App\Http\Middleware;

use Closure;
use App\Ticket;
use Session;

class CheckEditTicket
{
    /**
     * Проверка на наличие открытых заявок у менеджера
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	$ticket = Ticket::where('session_id', Session::getId())->first();
    	if($ticket){
    		if($request->route()->getName() != 'ticketUpdate'){
				if($request->route()->getName() == 'ticket' and $request->id == $ticket->id){
					return $next($request);
				}
				else{
					Session::flash('messages', "Перед выходом заявку необходимо сохранить. Нажмите кнопку изменить.");
					return redirect()->route('ticket', ['id' => $ticket->id]);
				}
			}
    	}
    	return $next($request);
    }
}
