@extends('welcome')

@section('content')
<h3>Заявка № {{$ticket['id']}} от {{$ticket['date']}}</h3>
<hr />
<div class="row">
	<div class="col-sm">
		<div class="row">
			<div class="col-sm">
				<p><b>Заявитель:</b> {{$ticket['userName']}}</p>
				<p><b>Телефон:</b> {{$ticket['userPhone']}}</p>
				<p><b>Email:</b> {{$ticket['userEmail']}}</p>
			</div>
			<div class="col-sm">
				<p><b>Тип:</b> {{$ticket['ticketType']}}</p>
				<p><b>Приоритет:</b> {{$ticket['ticketPriority']}}</p>
			</div>
		</div>
		<hr />
		<p><b>{{$ticket['name']}}</b></p>
		<p>{{$ticket['description']}}</p>
		<hr />
		<form method="post" action="{{ route('ticketUpdate') }}" >
			{{ csrf_field() }}
			<input type="hidden" name="ticketId" value="{{$ticket['id']}}"/>
			<div class="form-group">
				<label for="commentTicket">Комментарий ТП</label>
				<textarea class="form-control" name="comment" id="commentTicket" placeholder="Комментарий">{{$ticket['comment']}}</textarea>
			</div>
			<hr />
			<div class="form-group">
				<label for="statusTicket">Статус</label>
				<select class="form-control" id="statusTicket" name="status">
					@foreach ($status as $v)
						@if($v->id == $ticket['ticketStatusId'])
							<option value="{{ $v->id }}" selected>{{ $v->name }}</option>
						@else
							<option value="{{ $v->id }}">{{ $v->name }}</option>
						@endif
					@endforeach
				</select>
			</div>
			@if($ticket['edit'] != '')
				<div class="alert alert-danger" role="alert">
					<p>Заявка редактируется другим менеджером, Ваши изменения не сохранятся!</p>
					<a href="{{route('admin')}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">
						Вернуться назад
					</a>
				</div>
			@else
				<button type="submit" class="btn btn-primary">Изменить</button>
			@endif
		</form>
		
	</div>
	<div class="col-sm">
		
	</div>
</div>

@endsection