<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketCRUD;
use App\TicketStatus;
use App\TicketPriority;
use App\TicketType;
use Session;

class AdminController extends Controller
{
	private $request;
	private $ticketModel;
	
	public function __construct(Request $request,TicketCRUD $crud){
		$this->request = $request;
		$this->ticketModel = $crud;
	}
	
	/**
     * Получить все заявки
     *
     * @return mixed
     */
    public function listTickets()
    {
		$allTickets = $this->ticketModel->getAllTickets($this->request);
		
		$data['priority'] = TicketPriority::all();
		$data['type'] = TicketType::all();
		$data['status'] = TicketStatus::all();
			
		if($allTickets){
			$data['tickets'] = $allTickets;
			return view('admin',$data);
		}
		else{
			$data['tickets'] = [];
			Session::flash('messages', "Нет записей по данному фильтру.");
			return view('admin',$data);
		}
	}
	
	/**
     * Вывести одну заявку по id
     *
     * @param  $id int
     * @return mixed
     */
	public function getTicket($id)
	{
		$ticket = $this->ticketModel->getTicket($id);
		if($ticket){
			$data['status'] = TicketStatus::all();
			$data['ticket'] = $ticket;
			return view('ticket',$data);
		}
		else{
			Session::flash('messages', "Запись не найдена.");
			return $this->listTickets();
		}
	}
	
	/**
     * Обновить заявку
     *
     * @return mixed
     */
	public function updateTicket()
	{
		$ticket = $this->ticketModel->updateTicket($this->request);
		
		if($ticket){
			Session::flash('messages', "Заявка № ".$this->request->ticketId." изменена.");
		}else{
			Session::flash('messages', "Ошибка при обновлении заявки.");
		}
		return redirect()->route('admin');
	}
}
