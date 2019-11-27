@extends('welcome')

@section('content')
<h3>Новая заявка</h3>
<div class="row">
	<div class="col-sm">
		<form method="post" action="{{ route('home') }}" >
			{{ csrf_field() }}
			<div class="form-group">
				<label for="companyNane">ID Компании</label>
				<input type="text" name="id" class="form-control" id="companyNane" placeholder="Введите целое число"  value="{{ old('id') }}" required>
				@error('id')
					<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label for="titleTicket">Заголовок</label>
				<input type="text" name="title" class="form-control" id="titleTicket" placeholder="Тема" value="{{ old('title') }}" required>
				@error('title')
					<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label for="descriptionTicket">Описание проблемы</label>
				<textarea class="form-control" name="description" id="descriptionTicket" placeholder="Описание проблемы" required>{{ old('description') }}</textarea>
				@error('description')
					<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label for="typeTicket">Тип заявки</label>
				<select class="form-control" id="typeTicket" name="type">
					@foreach ($type as $v)
					    <option value="{{ $v->id }}">{{ $v->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="priorityTicket">Приоритет</label>
				<select class="form-control" id="priorityTicket" name="priority">
					@foreach ($priority as $v)
					    <option value="{{ $v->id }}">{{ $v->name }}</option>
					@endforeach
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Отправить</button>
		</form>
	</div>
	<div class="col-sm">
		<div class="alert alert-success" role="alert">
		  <p>При отсутствии в базе данных пользователя с id = ID Компании, он будет создан автоматически со всеми атрибутами: имя, email, телефон.</p>
		  <p>Apache 2.2, PHP 7.2, MySQL 5.6, Laravel 6.2</p>
		</div>
	</div>
</div>
@endsection