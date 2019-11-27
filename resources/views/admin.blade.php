@extends('welcome')

@section('content')
<h3>Панель администратора</h3>
<hr />
<form method="post" action="{{ route('admin') }}" >
	{{ csrf_field() }}
	<input type="hidden" name="filter" value="1">
	<div class="row">
		<div class="col-sm">
			<div class="form-group">
				<label for="priorityTicket">Приоритет</label>
				<select class="form-control form-control-sm" id="priorityTicket" name="priority">
					<option value="0"> - </option>
					@foreach ($priority as $v)
						@if($v->id == session('priority'))
							<option value="{{ $v->id }}" selected>{{ $v->name }}</option>
						@else
							<option value="{{ $v->id }}">{{ $v->name }}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-sm">
			<div class="form-group">
				<label for="statusTicket">Статус</label>
				<select class="form-control form-control-sm" id="statusTicket" name="status">
					<option value="0"> - </option>
					@foreach ($status as $v)
					    @if($v->id == session('status'))
							<option value="{{ $v->id }}" selected>{{ $v->name }}</option>
						@else
							<option value="{{ $v->id }}">{{ $v->name }}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-sm">
			<div class="form-group">
				<label for="typeTicket">Тип</label>
				<select class="form-control form-control-sm" id="typeTicket" name="type">
					<option value="0"> - </option>
					@foreach ($type as $v)
					    @if($v->id == session('type'))
							<option value="{{ $v->id }}" selected>{{ $v->name }}</option>
						@else
							<option value="{{ $v->id }}">{{ $v->name }}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-sm my-auto mx-auto">
			<button type="submit" class="btn btn-primary">Применить фильтр</button>
			<div class="form-check">
				<input class="form-check-input" type="checkbox" id="resetFilter" name="resetFilter">
				<label class="form-check-label" for="resetFilter">
					Сбросить фильтры
				</label>
			</div>
		</div>
	</div>
</form>
<hr />
<table class="table table-striped">
	<thead>
		<tr>
			<th scope="col">ID</th>
			<th scope="col">Компания</th>
			<th scope="col">Дата</th>
			<th scope="col">Тема</th>
			<th scope="col">Тип</th>
			<th scope="col">Приоритет</th>
			<th scope="col">Статус</th>
			<th scope="col">Время в работе</th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($tickets as $v)
			<tr>
			    <th scope="row">{{$v['id']}}</th>
				<td>{{$v['userName']}}</td>
				<td><small>{{$v['date']}}</small></td>
				<td>{{$v['name']}}</td>
				<td>{{$v['ticketType']}}</td>
				<td>{{$v['ticketPriority']}}</td>
				<td>{{$v['ticketStatus']}}</td>
				<td>{{$v['totalTime']}}</td>
				<td>
					<a href="{{route('ticket', ['id' => $v['id']])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">
						@if($v['edit'] != '')
							Редактируется!
						@else
							Открыть
						@endif
					</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

@endsection