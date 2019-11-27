<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketCRUD;
use App\TicketPriority;
use App\TicketType;
use Session;
use Validator;

class TicketController extends Controller
{
	/**
     * Отобразить форму заявки
     *
     * @return mixed
     */
	public function showFormTicket()
	{
		$data['priority'] = TicketPriority::all();
		$data['type'] = TicketType::all();
	    return view('home',$data);
	}
	
	/**
     * Создать новую заявку
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function addTicket(Request $request)
    {
    	// Валидатор формы
    	$rules = [
		    'id'          => 'required|numeric',
		    'title'       => 'required|max:255',
		    'description' => 'required',
		];
		$messages = [
			'required' => 'Обязательно к заполнению',
			'numeric'  => 'Только целые числа',
			'max'      => 'Превышен лимит строки',
		];
		
    	$validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
                
    	$newTicketModel = new TicketCRUD();
    	$addTicket = $newTicketModel->newTicket($request);
    	if($addTicket){
    		$data['priority'] = TicketPriority::all();
			$data['type'] = TicketType::all();
			Session::flash('messages', "Заявка № $addTicket создана.");
			return view('home',$data);
		}  		
	}
}
