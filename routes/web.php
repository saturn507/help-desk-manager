<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'TicketController@showFormTicket')->name('home');
Route::post('/', 'TicketController@addTicket');

Route::match(['get', 'post'],'/admin', 'AdminController@listTickets')->name('admin');
Route::get('/admin/ticket/{id}', 'AdminController@getTicket')->where(['id' => '[0-9]+'])->name('ticket');
Route::post('/admin/ticket', 'AdminController@updateTicket')->name('ticketUpdate');